<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use frontend\models\Student;
use frontend\models\StudentSemester;
use frontend\models\GraduationSemester;
use yii\web\Response;
use yii\captcha\CaptchaAction;
use yii\db;
use yii\helpers\HtmlPurifier;

class OudeController extends Controller
{
	/*
	->where(['like', 'mssv', $mssv])
	->andFilterWhere(['or', ['like', 'CONCAT(ho, " ", ten)', $username], ['like', 'CONCAT(ho_kd, " ", ten_kd)' , $username]])
	*/
	
	/* easy command
	 *
	$data = \Yii::$app->db->createCommand('SELECT tb_hk_tot_nghiep.*, tb_sv_hk.*, tb_sinh_vien.*, tb_ho_so_sv.ma_noi_sinh, tb_tinh_thanh.ten_tinh_thanh 
											FROM tb_hk_tot_nghiep 
											INNER JOIN tb_sv_hk ON `tb_sv_hk`.`ma_hk` = `tb_hk_tot_nghiep`.`ma_hk` 
											INNER JOIN tb_sinh_vien ON `tb_sinh_vien`.`mssv` = `tb_sv_hk`.`mssv` 
											INNER JOIN tb_ho_so_sv ON `tb_ho_so_sv`.`mssv` = `tb_sinh_vien`.`mssv` 
											INNER JOIN tb_tinh_thanh ON `tb_tinh_thanh`.`ma_tinh_thanh` = `tb_ho_so_sv`.`ma_noi_sinh` WHERE tb_sinh_vien.mssv = "32163013VT2"')->queryAll();
	*
	*/
	
	/* query builder
	 *
	$allStudentInSemester = (new \yii\db\Query())
							->select('tb_hk_tot_nghiep.*, tb_sv_hk.*, tb_sinh_vien.*, tb_ho_so_sv.ma_noi_sinh, tb_tinh_thanh.ten_tinh_thanh')
							->from(['tb_hk_tot_nghiep'])
							->innerJoin('tb_sv_hk', '`tb_sv_hk`.`ma_hk` = `tb_hk_tot_nghiep`.`ma_hk`')
							->innerJoin('tb_sinh_vien', '`tb_sinh_vien`.`mssv` = `tb_sv_hk`.`mssv`')
							->innerJoin('tb_ho_so_sv', '`tb_ho_so_sv`.`mssv` = `tb_sinh_vien`.`mssv`')
							->innerJoin('tb_tinh_thanh', '`tb_tinh_thanh`.`ma_tinh_thanh` = `tb_ho_so_sv`.`ma_noi_sinh`')
							->all();
	*
	*/
	
	public $layout = 'demo1'; // sử dụng layout demo1
	
	public function actions()
	{
		return [
			'captcha' => [ // gắn captcha 
				'class' => 'yii\captcha\CaptchaAction',
				//'enableClientValidation' => false,
			],
		];
	}
	
    public function actionIndex()
    {
		$allGraduationSemester = GraduationSemester::find()->select(['chi_tiet_hk'])->indexBy('ma_hk')->column(); // lấy tất cả học kì hiện có trong database để thêm vào dropdownlist
		return $this->render('index', [
			'allGraduationSemester' => $allGraduationSemester,
		]);
		
    }
	
	public function actionDetailForOneSemester($mssv, $hk) // xử lý ajax khi tìm theo học kì 
	{
		if(\Yii::$app->request->isAjax){
			
			\Yii::$app->response->format = Response::FORMAT_JSON;
			
			$detailStudent = StudentSemester::find()
							->where([
								'tb_sv_hk.mssv' => $mssv,
								'tb_sv_hk.ma_hk' => $hk
							])
							->limit(1)
							->one(); // trả về đúng 1 sinh viên theo kết quả tìm kiếm
			
			$detailStudentArray = [];
			
			array_push($detailStudentArray, $detailStudent->student->linkedUnit->ma_dvlk);
			array_push($detailStudentArray, $detailStudent->student->linkedUnit->ten_dvlk);
			array_push($detailStudentArray, $detailStudent->student->nation->ten_dan_toc);
			array_push($detailStudentArray, $detailStudent->student->country->ten_quoc_tich);
			array_push($detailStudentArray, $detailStudent->student->major->ten_nganh);
			array_push($detailStudentArray, $detailStudent->giay_ks);
			array_push($detailStudentArray, $detailStudent->bang_cap);
			array_push($detailStudentArray, $detailStudent->hinh);
			array_push($detailStudentArray, $detailStudent->phieu_dkxcb);
			array_push($detailStudentArray, $detailStudent->ct_dt);
			array_push($detailStudentArray, $detailStudent->student->trainingForm->ten_hinh_thuc_at);
			array_push($detailStudentArray, $detailStudent->diem);
			array_push($detailStudentArray, $detailStudent->xep_loai);
			array_push($detailStudentArray, $detailStudent->dk_tn);
			array_push($detailStudentArray, $detailStudent->student->mssv);
			array_push($detailStudentArray, $detailStudent->student->ho);
			array_push($detailStudentArray, $detailStudent->student->ten);
			
			return $detailStudentArray;
		}
	}
	
	public function actionStudentAllSemester($mssv) // tìm sinh viên không theo học kì
	{
		if(\Yii::$app->request->isAjax){
			
			\Yii::$app->response->format = Response::FORMAT_JSON; // nhằm mục đích trả kết quả về dạng json 
			
			$students = Student::find()
						->innerJoinWith('graduationSemesters')
						->where([
							'tb_sinh_vien.mssv' => $mssv
						])
						->all();
			
			return [
				'graduationSemes' => $students[0]->graduationSemesters, // chỉ xử lý trên 1 sinh viên nên chỉ sô là o ( chỉ có duy nhất 1 sinh viên )
				'studentSemes' => $students[0]->studentSemester
			];
		}
	}
	
	public function actionDetailForAllSemester($mssv, $hk)
	{
		if(\Yii::$app->request->isAjax){
			
			\Yii::$app->response->format = Response::FORMAT_JSON;
			
			$detailStudent = StudentSemester::find()
							->where([
								'tb_sv_hk.mssv' => $mssv,
								'tb_sv_hk.ma_hk' => $hk
							])
							->limit(1)
							->one();
			
			$detailStudentArray = [];
			
			array_push($detailStudentArray, $detailStudent->student->linkedUnit->ma_dvlk);
			array_push($detailStudentArray, $detailStudent->student->linkedUnit->ten_dvlk);
			array_push($detailStudentArray, $detailStudent->student->nation->ten_dan_toc);
			array_push($detailStudentArray, $detailStudent->student->country->ten_quoc_tich);
			array_push($detailStudentArray, $detailStudent->student->major->ten_nganh);
			array_push($detailStudentArray, $detailStudent->giay_ks);
			array_push($detailStudentArray, $detailStudent->bang_cap);
			array_push($detailStudentArray, $detailStudent->hinh);
			array_push($detailStudentArray, $detailStudent->phieu_dkxcb);
			array_push($detailStudentArray, $detailStudent->ct_dt);
			array_push($detailStudentArray, $detailStudent->student->trainingForm->ten_hinh_thuc_at);
			array_push($detailStudentArray, $detailStudent->diem);
			array_push($detailStudentArray, $detailStudent->xep_loai);
			array_push($detailStudentArray, $detailStudent->dk_tn);
			array_push($detailStudentArray, $detailStudent->student->mssv);
			array_push($detailStudentArray, $detailStudent->student->ho);
			array_push($detailStudentArray, $detailStudent->student->ten);
			
			return $detailStudentArray;
		}
	}
	
	public function actionCreate()
	{
		
		$allStudentInSemester = [];
		
		if(\Yii::$app->request->isAjax)
		{
			\Yii::$app->response->format = Response::FORMAT_JSON;
			
			
			$username = \Yii::$app->request->post('username');
			$semester = \Yii::$app->request->post('semester');
			$captcha = \Yii::$app->request->post('captcha');
			$mssv = \Yii::$app->request->post('mssv');
		
			$errors = '';
		
			$data = [];
		
			$model = new Student();
			
			$model->scenario = Student::SCENARIO_FIND;
			
			$model->mssv = HtmlPurifier::process($mssv);
			
			$model->username = HtmlPurifier::process($username);
			
			$model->captcha = $captcha;
			
			$model->semester = HtmlPurifier::process($semester);
			
			$verifyCaptcha = new CaptchaAction();
			
			if($model->validate() and $model->captcha == $verifyCaptcha->getVerifyCode()) //////////////////////// !!!!! \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
			{
				
				if ($model->semester == 'all')
				{
					$allStudentInSemester = Student::find()
					
								->innerJoinWith('province')
								->where(['like', 'tb_sinh_vien.mssv', $model->mssv])
								->andFilterWhere(['or', ['like', 'CONCAT(tb_sinh_vien.ho, " ", tb_sinh_vien.ten)', $model->username], ['like', 'CONCAT(tb_sinh_vien.ho_kd, " ", tb_sinh_vien.ten_kd)' , $model->username]])
								->with(['province'])
								->all();
					
					
					foreach($allStudentInSemester as $item)
					{
						$temp = [];
						$temp[] = $item->mssv;
						$temp[] = $item->ho;
						$temp[] = $item->ten;
						$temp[] = $item->ngay_sinh;
						$temp[] = $item->province->ten_tinh_thanh;
						$temp[] = $item->gioi_tinh;
						
						$data[] = $temp;
					}
					
				}
				else
				{
					$allStudentInSemester = Student::find()
								->innerJoinWith('graduationSemesters')
								->innerJoinWith('province')
								->where(['tb_hk_tot_nghiep.ma_hk' => $model->semester])
								->andWhere(['like', 'tb_sinh_vien.mssv', $model->mssv])
								->andFilterWhere(['or', ['like', 'CONCAT(tb_sinh_vien.ho, " ", tb_sinh_vien.ten)', $model->username], ['like', 'CONCAT(tb_sinh_vien.ho_kd, " ", tb_sinh_vien.ten_kd)' , $model->username]])
								->all();
							
					$detailSemester = GraduationSemester::find()
							->where(['tb_hk_tot_nghiep.ma_hk' => $model->semester])
							->one();
					
						
					foreach($allStudentInSemester as $item)
					{
						$temp = [];
						$temp[] = $item->mssv;
						$temp[] = $item->ho;
						$temp[] = $item->ten;
						$temp[] = $item->ngay_sinh;
						$temp[] = $item->province->ten_tinh_thanh;
						$temp[] = $item->gioi_tinh;
						$temp[] = $detailSemester->chi_tiet_hk;
						$temp[] = $detailSemester->ma_hk;
						$data[] = $temp;
					}
				}
				
			}
			else
			{
				$errors = $model->errors;
			}
			
			
		}
		return [
			'allStudentInSemester' => $data,
			'errors' => $errors,
			'test' => $verifyCaptcha->getVerifyCode()
			
		];
	}
	
	
}