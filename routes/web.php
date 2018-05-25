<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'admin','middleware'=>'adminmiddleware'],function(){
	Route::get('dashbroad',['as'=>'admin.dashbroad','uses'=>'usercontroller@getdashbroad']);
	Route::group(['prefix'=>'loaitin'],function(){
		Route::get('danhsach',['as'=>'admin.loaitin.danhsach','uses'=>'loaitincontroller@getdanhsach']);
		Route::get('them',['as'=>'admin.loaitin.getthem','uses'=>'loaitincontroller@getthem']);
		Route::post('them',['as'=>'admin.loaitin.them','uses'=>'loaitincontroller@them']);
		Route::get('sua/{ma}',['as'=>'admin.loaitin.getsua','uses'=>'loaitincontroller@getsua']);
		Route::post('sua',['as'=>'admin.loaitin.sua','uses'=>'loaitincontroller@sua']);
		Route::get('xoa/{ma}',['as'=>'admin.loaitin.xoa','uses'=>'loaitincontroller@xoa']);
	});
	Route::group(['prefix'=>'baiviet'],function(){
		Route::get('danhsach',['as'=>'admin.baiviet.danhsach','uses'=>'baivietcontroller@getdanhsach']);
		Route::get('them',['as'=>'admin.baiviet.getthem','uses'=>'baivietcontroller@getthem']);
		Route::post('them',['as'=>'admin.baiviet.them','uses'=>'baivietcontroller@them']);
		Route::get('sua/{idbv}',['as'=>'admin.baiviet.getsua','uses'=>'baivietcontroller@getsua']);
		Route::post('sua',['as'=>'admin.baiviet.sua','uses'=>'baivietcontroller@sua']);
		Route::get('xoa/{idbv}',['as'=>'admin.baiviet.xoa','uses'=>'baivietcontroller@xoa']);
		Route::get('xoacmt/{idcmt}/{idbv}',['as'=>'admin.baiviet.xoacmt','uses'=>'baivietcontroller@xoacmt']);
	});
	Route::group(['prefix'=>'comment'],function(){
		Route::get('xoalp/{idlp}',['as'=>'admin.comment.xoalp','uses'=>'commentcontroller@xoalp']);
		Route::get('xoaimg/{idanh}',['as'=>'admin.comment.xoaimg','uses'=>'commentcontroller@xoaimg']);
		Route::get('danhsach',['as'=>'admin.comment.danhsach','uses'=>'commentcontroller@getdanhsach']);

	});
	Route::group(['prefix'=>'khuvuc'],function(){
		Route::get('danhsach',['as'=>'admin.khuvuc.danhsach','uses'=>'khuvuccontroller@getdanhsach']);
		Route::get('them',['as'=>'admin.khuvuc.getthem','uses'=>'khuvuccontroller@getthem']);
		Route::post('them',['as'=>'admin.khuvuc.them','uses'=>'khuvuccontroller@them']);
		Route::get('sua/{idkv}',['as'=>'admin.khuvuc.getsua','uses'=>'khuvuccontroller@getsua']);
		Route::post('sua',['as'=>'admin.khuvuc.sua','uses'=>'khuvuccontroller@sua']);
		Route::get('xoa/{idkv}',['as'=>'admin.khuvuc.xoa','uses'=>'khuvuccontroller@xoa']);

	});
	Route::group(['prefix'=>'user'],function(){
		Route::get('danhsach',['as'=>'admin.user.danhsach','uses'=>'usercontroller@getdanhsach']);
		Route::get('them',['as'=>'admin.user.getthem','uses'=>'usercontroller@getthem']);
		Route::post('them',['as'=>'admin.user.them','uses'=>'usercontroller@them']);
		Route::get('sua/{iduser}',['as'=>'admin.user.getsua','uses'=>'usercontroller@getsua']);
		Route::post('sua',['as'=>'admin.user.sua','uses'=>'usercontroller@sua']);
		Route::get('xoa/{iduser}',['as'=>'admin.user.xoa','uses'=>'usercontroller@xoa']);

	});
	Route::group(['prefix'=>'khachhang'],function(){
		Route::get('danhsach',['as'=>'admin.khachhang.danhsach','uses'=>'khachhangcontroller@getdanhsach']);
	});
	Route::group(['prefix'=>'khachsan'],function(){
		Route::get('danhsach',['as'=>'admin.khachsan.danhsach','uses'=>'khachsancontroller@getdanhsach']);
		Route::get('them',['as'=>'admin.khachsan.getthem','uses'=>'khachsancontroller@getthem']);
		Route::post('them',['as'=>'admin.khachsan.them','uses'=>'khachsancontroller@them']);
		Route::get('sua/{idKS}',['as'=>'admin.khachsan.getsua','uses'=>'khachsancontroller@getsua']);
		Route::post('sua',['as'=>'admin.khachsan.sua','uses'=>'khachsancontroller@sua']);
		Route::get('xoa/{idKS}',['as'=>'admin.khachsan.xoa','uses'=>'khachsancontroller@xoa']);
	});
	Route::group(['prefix'=>'chinhsach'],function(){
		/*Route::get('danhsach',['as'=>'admin.chinhsach.danhsach','uses'=>'chinhsachcontroller@getdanhsach']);*/
		/*Route::get('them',['as'=>'admin.chinhsach.getthem','uses'=>'chinhsachcontroller@getthem']);
		Route::post('them',['as'=>'admin.chinhsach.them','uses'=>'chinhsachcontroller@them']);*/
		Route::get('sua/{idKS}',['as'=>'admin.chinhsach.getsua','uses'=>'chinhsachcontroller@getsua']);
		Route::post('sua',['as'=>'admin.chinhsach.sua','uses'=>'chinhsachcontroller@sua']);
		Route::get('xoa/{idCS}',['as'=>'admin.chinhsach.xoa','uses'=>'chinhsachcontroller@xoa']);
	});
	Route::group(['prefix'=>'tienich'],function(){
		Route::get('danhsach',['as'=>'admin.tienich.danhsach','uses'=>'tienichcontroller@getdanhsach']);
		Route::get('them',['as'=>'admin.tienich.getthem','uses'=>'tienichcontroller@getthem']);
		Route::post('them',['as'=>'admin.tienich.them','uses'=>'tienichcontroller@them']);
		Route::get('sua/{idtienich}',['as'=>'admin.tienich.getsua','uses'=>'tienichcontroller@getsua']);
		Route::post('sua',['as'=>'admin.tienich.sua','uses'=>'tienichcontroller@sua']);
		Route::get('xoa/{idtienich}',['as'=>'admin.tienich.xoa','uses'=>'tienichcontroller@xoa']);
	});
	Route::group(['prefix'=>'don'],function(){
		Route::get('dondatphong',['as'=>'admin.don.dondatphong','uses'=>'dondatphongcontroller@getdanhsach']);
		Route::get('dontheoks/{idks}',['as'=>'admin.don.dontheoks','uses'=>'dondatphongcontroller@getdanhsachtheoks']);
		Route::get('them',['as'=>'admin.don.getthem','uses'=>'dondatphongcontroller@getthem']);
		Route::post('them',['as'=>'admin.don.them','uses'=>'dondatphongcontroller@them']);
		Route::get('sua/{id}',['as'=>'admin.don.getsua','uses'=>'dondatphongcontroller@getsua']);
		Route::post('sua',['as'=>'admin.don.sua','uses'=>'dondatphongcontroller@sua']);
		Route::get('xoa/{id}',['as'=>'admin.don.xoa','uses'=>'dondatphongcontroller@xoa']);
		Route::post('duyet',['as'=>'admin.don.duyet','uses'=>'dondatphongcontroller@duyet']);
	});


	Route::group(['prefix'=>'tour'],function(){
		Route::get('list',['as'=>'admin.list.tour','uses'=>'TourController@getList']);
		Route::get('getadd',['as'=>'admin.tour.getadd','uses'=>'TourController@getAdd']);
		Route::post('add',['as'=>'admin.tour.add','uses'=>'TourController@add']);
		Route::get('detail/{id}',['as'=>'admin.tour.getdetail','uses'=>'TourController@getDetail']);
		//Route::get('getupdate',['as'=>'admin.tour.getadd','uses'=>'TourController@getUpdate']);
		Route::post('update/{idtour}',['as'=>'admin.tour.update','uses'=>'TourController@updateInfo']);
		Route::get('delimg/{idanh}',['as'=>'admin.tour.delimg','uses'=>'TourController@delImg']);
		Route::post('updateimg/{idtour}',['as'=>'admin.tour.updateimg','uses'=>'TourController@updateImg']);
		Route::get('delete/{idtour}',['as'=>'admin.tour.delete','uses'=>'TourController@delete']);
	});

	Route::group(['prefix'=>'dichvu'],function(){
		Route::get('list',['as'=>'admin.list.dichvu','uses'=>'DichVuController@getList']);
		Route::get('getadd',['as'=>'admin.dichvu.getadd','uses'=>'DichVuController@getAdd']);
		Route::post('add',['as'=>'admin.dichvu.add','uses'=>'DichVuController@add']);
		Route::get('getupdate/{id}',['as'=>'admin.dichvu.getupdate','uses'=>'DichVuController@getUpdate']);
		Route::post('update/{id}',['as'=>'admin.dichvu.update','uses'=>'DichVuController@update']);
		Route::get('delete/{id}',['as'=>'admin.dichvu.delete','uses'=>'DichVuController@delete']);
	});

	Route::group(['prefix'=>'dichvudikem'],function(){
		Route::get('getadd/{id}',['as'=>'admin.dichvudikem.getadd','uses'=>'DichVuDiKemController@getAdd']);
		Route::post('add/{idTour}/{idDichVu}',['as'=>'admin.dichvudikem.add','uses'=>'DichVuDiKemController@add']);
		Route::post('update/{idTour}/{idDichVu}',['as'=>'admin.dichvudikem.update','uses'=>'DichVuDiKemController@update']);
		Route::post('delete/{idTour}/{idDichVu}',['as'=>'admin.dichvudikem.delete','uses'=>'DichVuDiKemController@delete']);
	});

	Route::group(['prefix'=>'thanhpho'],function(){
		Route::get('list',['as'=>'admin.list.thanhpho','uses'=>'ThanhPhoController@getList']);
		Route::get('getadd',['as'=>'admin.thanhpho.getadd','uses'=>'ThanhPhoController@getAdd']);
		Route::post('add',['as'=>'admin.thanhpho.add','uses'=>'ThanhPhoController@add']);
		Route::get('getupdate/{id}',['as'=>'admin.thanhpho.getupdate','uses'=>'ThanhPhoController@getUpdate']);
		Route::post('update/{id}',['as'=>'admin.thanhpho.update','uses'=>'ThanhPhoController@update']);
		Route::get('delete/{id}',['as'=>'admin.thanhpho.delete','uses'=>'ThanhPhoController@delete']);
	});

	Route::group(['prefix'=>'khuvuc'],function(){
		Route::get('list',['as'=>'admin.list.khuvuc','uses'=>'KhuVucController@getList']);
		Route::get('getadd',['as'=>'admin.khuvuc.getadd','uses'=>'KhuVucController@getAdd']);
		Route::post('add',['as'=>'admin.khuvuc.add','uses'=>'KhuVucController@add']);
		Route::get('getupdate/{id}',['as'=>'admin.khuvuc.getupdate','uses'=>'KhuVucController@getUpdate']);
		Route::post('update/{id}',['as'=>'admin.khuvuc.update','uses'=>'KhuVucController@update']);
		Route::get('delete/{id}',['as'=>'admin.khuvuc.delete','uses'=>'KhuVucController@delete']);
		Route::get('getkhuvuclist/{idThanhPho}',['as'=>'admin.khuvuc.getkhuvuclist','uses'=>'KhuVucController@getKhuVuc']);
	});

	Route::group(['prefix'=>'phuongtien'],function(){
		Route::get('list',['as'=>'admin.list.phuongtien','uses'=>'PhuongTienController@getList']);
		Route::get('getadd',['as'=>'admin.phuongtien.getadd','uses'=>'PhuongTienController@getAdd']);
		Route::post('add',['as'=>'admin.phuongtien.add','uses'=>'PhuongTienController@add']);
		Route::get('getupdate/{id}',['as'=>'admin.phuongtien.getupdate','uses'=>'PhuongTienController@getUpdate']);
		Route::post('update/{id}',['as'=>'admin.phuongtien.update','uses'=>'PhuongTienController@update']);
		Route::get('delete/{id}',['as'=>'admin.phuongtien.delete','uses'=>'PhuongTienController@delete']);
	});

	Route::group(['prefix'=>'phuongtiendikem'],function(){
		Route::get('getadd/{id}',['as'=>'admin.phuongtiendikem.getadd','uses'=>'PhuongTienDiKemController@getAdd']);
		Route::post('add/{idTour}/{idPhuongTien}',['as'=>'admin.phuongtiendikem.add','uses'=>'PhuongTienDiKemController@add']);
		Route::post('update/{idTour}/{idPhuongTien}',['as'=>'admin.phuongtiendikemdikem.update','uses'=>'PhuongTienDiKemController@update']);
		Route::post('delete/{idTour}/{idPhuongTien}',['as'=>'admin.phuongtiendikem.delete','uses'=>'PhuongTienDiKemController@delete']);
	});

	Route::group(['prefix'=>'lichtrinh'],function(){
		Route::get('getadd/{idtour}',['as'=>'admin.lichtrinh.getadd','uses'=>'LichTrinhController@getList']);
		Route::post('add/{id}',['as'=>'admin.lichtrinh.add','uses'=>'LichTrinhController@add']);
		Route::get('getupdate/{id}',['as'=>'admin.lichtrinh.getupdate','uses'=>'LichTrinhController@getUpdate']);
		Route::post('update/{id}',['as'=>'admin.lichtrinh.update','uses'=>'LichTrinhController@update']);
		Route::get('delete/{id}',['as'=>'admin.phuongtien.delete','uses'=>'LichTrinhController@delete']);
	});

	Route::group(['prefix'=>'lichkhoihanh'],function(){
		Route::get('getadd/{idtour}',['as'=>'admin.lichkhoihanh.getadd','uses'=>'LichKhoiHanhController@getAdd']);
		Route::post('add',['as'=>'admin.lichkhoihanh.next','uses'=>'LichKhoiHanhController@complete']);
		Route::get('delete/{id}',['as'=>'admin.lichkhoihanh.delete','uses'=>'LichKhoiHanhController@delete']);
	});

	Route::group(['prefix'=>'loaitour'],function(){
		Route::get('list',['as'=>'admin.list.loaitour','uses'=>'LoaiTourController@getList']);
		Route::get('getadd',['as'=>'admin.loaitour.getadd','uses'=>'LoaiTourController@getAdd']);
		Route::post('add',['as'=>'admin.loaitour.add','uses'=>'LoaiTourController@add']);
		Route::get('getupdate/{id}',['as'=>'admin.loaitour.getupdate','uses'=>'LoaiTourController@getUpdate']);
		Route::post('update/{id}',['as'=>'admin.loaitour.update','uses'=>'LoaiTourController@update']);
		/*Route::get('delete/{id}',['as'=>'admin.loaitour.delete','uses'=>'LoaiTourController@delete']);*/
	});

	Route::group(['prefix'=>'nhomnguoidung'],function(){
		Route::get('list',['as'=>'admin.list.nhomnguoidung','uses'=>'NhomNguoiDungController@getList']);
		Route::get('getadd',['as'=>'admin.nhomnguoidung.getadd','uses'=>'NhomNguoiDungController@getAdd']);
		Route::post('add',['as'=>'admin.nhomnguoidung.add','uses'=>'NhomNguoiDungController@add']);
		Route::get('getupdate/{id}',['as'=>'admin.nhomnguoidung.getupdate','uses'=>'NhomNguoiDungController@getUpdate']);
		Route::post('update/{id}',['as'=>'admin.nhomnguoidung.update','uses'=>'NhomNguoiDungController@update']);
		Route::get('delete/{id}',['as'=>'admin.nhomnguoidung.delete','uses'=>'NhomNguoiDungController@delete']);
	});

	Route::group(['prefix'=>'phanquyentheonhom'],function(){
		Route::get('getlist',['as'=>'admin.phanquyentheonhom.getlist','uses'=>'PhanQuyenTheoNhomController@getList']);
		Route::post('ajaxgetrightlist',['as'=>'admin.getrightlist','uses'=>'PhanQuyenTheoNhomController@ajaxGetList']);
		Route::post('ajaxaddpermit',['as'=>'admin.addpermit','uses'=>'PhanQuyenTheoNhomController@ajaxAddPermit']);
		Route::post('ajaxremovepermit',['as'=>'admin.addpermit','uses'=>'PhanQuyenTheoNhomController@ajaxRemovePermit']);
		Route::post('ajaxaddcpermit',['as'=>'admin.addpermit','uses'=>'PhanQuyenTheoNhomController@ajaxAddCPermit']);
	});

	Route::group(['prefix'=>'quanlykhachsan'],function(){
		Route::get('khachsaninfo',['as'=>'admin.khachsaninfo','uses'=>'QuanLyKhachSanController@getInfoByManager']);
		Route::get('khachsanpolicy',['as'=>'admin.khachsanpolicy','uses'=>'QuanLyKhachSanController@getPolicyByHotel']);
		Route::post('suapolicy',['as'=>'admin.policy.sua','uses'=>'QuanLyKhachSanController@suapolicy']);
		Route::post('suakhachsaninfo',['as'=>'admin.suakhachsaninfo','uses'=>'QuanLyKhachSanController@suakhachsaninfo']);
		Route::get('dondatphong',['as'=>'admin.dondatphong','uses'=>'QuanLyKhachSanController@getDonByHotel']);
		Route::post('duyetdon',['as'=>'admin.quanlykhachsan.duyetdon','uses'=>'QuanLyKhachSanController@duyet']);
		Route::post('huydon',['as'=>'admin.quanlykhachsan.huydon','uses'=>'QuanLyKhachSanController@huyDon']);
		Route::get('them',['as'=>'admin.quanlykhachsan.getthem','uses'=>'khachsancontroller@getthem']);
		Route::post('them',['as'=>'admin.quanlykhachsan.them','uses'=>'khachsancontroller@them']);
		
	});
	Route::group(['prefix'=>'dangkykhachsan'],function(){
		Route::get('getdangky',['as'=>'admin.dangky.getlist','uses'=>'DangKyKhachSanController@getList']);
	});


});

Route::group(['prefix'=>'blog'],function(){
	Route::get('homepage',['as'=>'blog.homepage','uses'=>'baivietcontroller@gethomepage']);
	Route::get('post/{id}',['as'=>'blog.post','uses'=>'baivietcontroller@getpost']);
	Route::get('themepost/{idlt}',['as'=>'blog.themepost','uses'=>'baivietcontroller@getthemepost']);
	Route::post('search',['as'=>'blog.searchpost','uses'=>'baivietcontroller@getsearch']);
	Route::get('locationpost/{idkhuvuc}',['as'=>'blog.locationpost','uses'=>'baivietcontroller@locationpost']);
});


Route::get('getview',function(){
	return view('frontendhotel.pages.home');
});
Route::get('getview1',function(){
	return view('frontend-order.home.home-content');
});
Route::get('getdata',['as'=>'getdata',function(){
	return view('gethoteldata_ver1');
}]);

Route::get('testhomepage',['as'=>'homepage','uses'=>'baivietcontroller@gethomepage']);



Route::get('dataprocess',['as'=>'dataprocess','uses'=>'baivietcontroller@getdeletepart']);
Route::post('dataprocess',['as'=>'postdeletedata','use'=>'baivietcontroller@savedeleted']);

Route::group(['prefix'=>'user'],function(){
	Route::get('register',['as'=>'user.getregister','uses'=>'Auth\RegisterController@getregister']);
	Route::post('register',['as'=>'user.postregister','uses'=>'Auth\RegisterController@postregister']);
	Route::get('login',['as'=>'user.getlogin','uses'=>'Auth\LoginController@getlogin']);
	Route::post('login',['as'=>'user.postlogin','uses'=>'Auth\LoginController@postlogin']);
	Route::get('logout',['as'=>'user.logout','uses'=>'Auth\LoginController@logout']);
	Route::get('comment1/{idbv}/{iduser}',['as'=>'user.comment1','uses'=>'commentcontroller@postcomment1']);
	Route::get('info/{iduser}',['as'=>'user.info','uses'=>'usercontroller@getinfo']);
	Route::post('infoimg',['as'=>'user.postimg','uses'=>'usercontroller@postimg']);
	Route::post('info',['as'=>'user.postinfo','uses'=>'usercontroller@postinfo']);
	Route::get('cmtinfo/{iduser}',['as'=>'user.getcmt','uses'=>'usercontroller@getcmt']);
	Route::get('loginsuccess',['as'=>'success','uses'=>'usercontroller@getsuccess']);
	Route::get('donphonginfo/{iduser}',['as'=>'user.donphonginfo','uses'=>'usercontroller@getdonphonginfo']);
});
Route::get('lienhe',['as'=>'getlienhe','uses'=>'mailcontroller@getlienhe']);
Route::post('lienhe',['as'=>'postlienhe','uses'=>'mailcontroller@postlienhe']);


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'hotel'],function(){
	Route::get('homepage',['as'=>'hotel.homepage','uses'=>'khachsancontroller@gethomepage']);
	Route::get('location1/{idkv}/{flag}/{idloai}/{min1}/{max1}/{idtienich}',['as'=>'hotel.location','uses'=>'khachsancontroller@getlocation1']);
	Route::get('hotelall/{flag}/{idloai}/{min1}/{max1}/{idtienich}',['as'=>'hotel.hotelall','uses'=>'khachsancontroller@gethotelall']);
	Route::get('detail/{idks}',['as'=>'hotel.detail','uses'=>'khachsancontroller@gethoteldetail']);
	Route::post('search',['as'=>'hotel.search','uses'=>'khachsancontroller@getsearch']);
	Route::post('dangkykhachsan/them',['as'=>'dangkykhachsan.ajaxthem','uses'=>'DangKyKhachSanController@add']);
});

Route::group(['prefix'=>'Tour'],function(){
	Route::get("Homepage",["as"=>"tour.homepage","uses"=>"TourFrontEndController@getHomepage"]);
	Route::get("location/{iddiadiem}",["as"=>"tour.location","uses"=>"TourOnePageController@getByDiaDiem"]);
	Route::get("clocation/{idkhuvuc}",["as"=>"tour.clocation","uses"=>"TourOnePageController@getByKhuVuc"]);
	Route::post("tourlist",["as"=>"tour.getlist","uses"=>"TourOnePageController@getList"]);
	Route::post("tourlist_ajaxsearch",["as"=>"tour.ajaxsearch","uses"=>"TourOnePageController@ajaxSearch"]);
});
	Route::group(['prefix'=>'don'],function(){
		Route::post('them',['as'=>'admin.datdon.them','uses'=>'dondatphongcontroller@them']);
		Route::get('sua/{id}',['as'=>'admin.don.getsua','uses'=>'dondatphongcontroller@getsua']);
	});
Route::group(['prefix'=>'notice'],function(){
		Route::get('getnotice',['as'=>'admin.notice.ajaxget','uses'=>'NotificationController@getNotification']);
	});


Route::get('gettourdata',function(){
	return view('gettourdata_v1'); 
});


