<?php

namespace App\Http\Controllers;
use App\Http\Requests\khachsanrequest;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Anh;
use App\AnhKhachSan;
use App\KhachSan;
use App\KhuVuc;
use App\loaiPhong;
use App\ChinhSach;
use App\TienIch;
use App\ChiTietTienIch;
use Illuminate\Support\Facades\Auth;
define("LOCAL",1);
define("ADMIN",4);

class khachsancontroller extends Controller
{
	public static function getdanhsach(){
        $danhsach=KhachSan::all();
        return view('touradmin.khachsan.danhsach',['danhsach'=>$danhsach]);
    }
    public function getthem(){
        $userRoleid=Auth::user()->level;
        $isadmin=false;
        $listhoteladmin=false;
        if($userRoleid==ADMIN){
            $isadmin=true;
            $listhoteladmin=DB::table('users')->where("level",HOTELADMIN)->get();
        }else if($userRoleid==HOTELADMIN){
            $isadmin=false;
        }else {
            return redirect()->route('blog.homepage');
        }
        $khuvuc = KhuVuc::select('IDKhuVuc','TenKV')->get()->toArray();
        $loaikhachsan=DB::table('loaikhachsan')->get();
        $tienich=DB::table('chitiettienich')->get();
        return view('touradmin.khachsan.them',compact('khuvuc','loaikhachsan','tienich','isadmin','listhoteladmin'));
    }
    public function them(khachsanrequest $request){
        $count=0;
        $min=0;
        $isadmin=self::isadmin();
        $khachsan= new KhachSan;
        $khachsan->TenKhachSan=$request->tenKS;
        $khachsan->IDLoaiKhachSan=$request->idLKS;
        $khachsan->DiaChi=$request->diachi;
        $khachsan->IDKhuVuc=$request->idKV;
        $khachsan->ThongTin=$request->thongtin;
        $khachsan->LienHe=$request->lienhe;
        if($isadmin==true){
            $khachsan->IDNguoiQuanLy=$request->hoteladminid;
        }else {
            $khachsan->IDNguoiQuanLy=Auth::user()->id;
        }
        $khachsan->save();

        $newkhachsan=DB::table('khachsan')->where('TenKhachSan',$request->tenKS)->where('IDLoaiKhachSan',$request->idLKS)->where('DiaChi',$request->diachi)->first();
        $chinhsach=new ChinhSach;
        $chinhsach->IDKhachSan=$newkhachsan->IDKhachSan;
        $chinhsach->NhanPhong=$request->nhanphong;
        $chinhsach->TraPhong=$request->traphong;
        $chinhsach->DiChuyen=$request->dichuyen;
        $chinhsach->HoatDong=$request->hoatdong;
        $chinhsach->HuongDan=$request->huongdan;
        $chinhsach->PhuThu=$request->phuthu;
        $chinhsach->save();

        if($request->tienich!=null){
            $count1=0;
            foreach ($request->tienich as $value) {
               $tienich= new TienIch;
               $tienich->IDKhachSan=$newkhachsan->IDKhachSan;
               $tienich->IDChiTiet=$request->tienich[$count1];
               $tienich->save();
               $count1+=1;
            }
        }



        if(Input::hasFile('hotelpic')){
        	foreach (Input::file('hotelpic') as $file) {
        		$anh= new Anh;
        		if(isset($file)){
	        		$picname=$file->getClientOriginalName();
	        		$location="img/hotelimg/".$picname;
	        		$file->move("img/hotelimg/",$picname);
	        		$anh->URL=$location;
                    $anh->LoaiAnh='anhkhachsan';
                    $anh->ID=$newkhachsan->IDKhachSan;
	        		$anh->save();
        		}
        	}
        }
        
        $sophong=0;
        if(!empty($request->typename['0'])){
             $min=$request->typecost[$count];
            foreach ($request->typename as $value) {
                $sophong+=$request->typeamount[$count];
                $loaiphong= new LoaiPhong;
                $loaiphong->IDKhachSan=$newkhachsan->IDKhachSan;
                $loaiphong->TenLoaiPhong=$value;
                $loaiphong->SoPhong=$request->typeamount[$count];
                $loaiphong->PhongTrong=$loaiphong->SoPhong;
                $loaiphong->Gia=$request->typecost[$count];
                $loaiphong->save();
                if($loaiphong->Gia<$min){
                    $min=$loaiphong->Gia;
                }
                $count+=1;

            }

        }
        DB::table("khachsan")->where('IDKhachSan',$newkhachsan->IDKhachSan)->update(["minprice"=>$min,"SoPhong"=>$sophong]);

        return redirect()->route('admin.khachsan.danhsach');

    }

    public function isadmin(){
        $userRoleid=Auth::user()->level;
        $isadmin=false;
        if($userRoleid==ADMIN){
            return true;
        }else {
            return false;
        }
    }

    public function getsua($idKS){
        $khachsan=KhachSan::where('IDKhachSan',$idKS)->get()->first();
         $khuvuc = KhuVuc::select('IDKhuVuc','TenKV')->whereNotIn('IDKhuVuc',[$khachsan->IDKhuVuc])->get();
        $loaikhachsan=DB::table('loaikhachsan')->whereNotIn('id',[$khachsan->IDLoaiKhachSan])->get();
        $curloaikhachsan=DB::table('loaikhachsan')->where('id',$khachsan->IDLoaiKhachSan)->get()->first();
        $curkhuvuc=DB::table('khuvuc')->where('IDKhuVuc',$khachsan->IDKhuVuc)->get()->first();
        $curloaiphong=DB::table('loaiphong')->where('IDKhachSan',$khachsan->IDKhachSan)->get();
        $curanh=DB::table('anh')->where('ID',$khachsan->IDKhachSan)->get();
        $tienich=DB::table('chitiettienich')->whereNotIn('id',TienIch::where('IDKhachSan',$idKS)->select('IDChiTiet')->get()->toArray())->get();
        $curtienich=DB::table('chitiettienich')->whereIn('id',TienIch::where('IDKhachSan',$idKS)->select('IDChiTiet')->get()->toArray())->get();
        return view('touradmin.khachsan.sua',compact('khachsan','khuvuc','loaikhachsan','curloaikhachsan','curkhuvuc','curloaiphong','curanh','tienich','curtienich'));
       
    }
    public function sua(Request $request){
        $sophong=0;
        $min=0;
         if(!empty($request->curtypename['0'])){
            $count=0;
            $min=$request->curtypecost[$count];
                foreach ($request->curtypename as $item) {
                    $sophong+=$request->curtypeamount[$count];
                    DB::table('loaiphong')->where('IDLoaiPhong',$request->curtypeid[$count])->update(['TenLoaiPhong'=>$request->curtypename[$count],'SoPhong'=>$request->curtypeamount[$count],'Gia'=>$request->curtypecost[$count]]);
                    if($request->curtypecost[$count]<$min){
                        $min=$request->curtypecost[$count];
                    }
                    $count+=1;
                }
            }

            if($request->curtienich!=null){

                $count2=0;
                foreach ($request->curtienich as $value) {
                    $tmp[]=$request->curtienich[$count2];
                    $count2+=1;
                }
                DB::table('tienich')->whereNotIn('IDChiTiet',$tmp)->delete();
            }else {
                DB::table('tienich')->where('IDKhachSan',$request->idKS)->delete();
            }

            if($request->newtienich!=null){
                $count3=0;
                foreach ($request->newtienich as $value) {
                $tienich= new TienIch;
               $tienich->IDKhachSan=$request->idKS;
               $tienich->IDChiTiet=$request->newtienich[$count3];
               $tienich->save();
               $count3+=1;
                }
            }

            if(!empty($request->typename['0'])){
                $count1=0;
                $min=$request->typecost[$count1];
            foreach ($request->typename as $value) {
                $sophong+=$request->typeamount[$count1];
                $loaiphong= new LoaiPhong;
                $loaiphong->IDKhachSan=$request->idKS;
                $loaiphong->TenLoaiPhong=$value;
                $loaiphong->SoPhong=$request->typeamount[$count1];
                $loaiphong->PhongTrong=$loaiphong->SoPhong;
                $loaiphong->Gia=$request->typecost[$count1];
                $loaiphong->save();
                if($request->typecost[$count1]<$min){
                    $min=$request->typecost[$count1];
                }
                $count1+=1;
            }
        }



            if($request->hotelpic!=null){
                $count=0;
                foreach($request->hotelpic as $item){
                    if(isset($item)){
                    $img=$item->getClientOriginalName();
                    $location="img/hotelimg/".$img;
                    DB::table('anh')->where('IDAnh',$request->idanh[$count])->update(['URL'=>$location]);
                    $count+=1;
                }
                }
            }

            if(Input::hasFile('hotelpicmore')){
            foreach (Input::file('hotelpicmore') as $file) {
                $anh= new Anh;
                if(isset($file)){
                    $picname=$file->getClientOriginalName();
                    $location="img/hotelimg/".$picname;
                    $file->move("img/hotelimg/",$picname);
                    $anh->URL=$location;
                    $anh->LoaiAnh='anhkhachsan';
                    $anh->ID=$request->idKS;
                    $anh->save();
                }
            }
        }
        DB::table('khachsan')->where('IDKhachSan',$request->idKS)->update(['TenKhachSan'=>$request->tenKS,'IDLoaiKhachSan'=>$request->idLKS,'DiaChi'=>$request->diachi,'IDKhuVuc'=>$request->idKV,'ThongTin'=>$request->thongtin,'LienHe'=>$request->LienHe,'SoPhong'=>$sophong,'minprice'=>$min]);
        return redirect()->route('admin.khachsan.danhsach');
    }
    
    public function xoa($idKS){
        DB::table('tienich')->where('IDKhachSan',$idKS)->delete();
        DB::table('khachsan')->where('IDKhachSan',$idKS)->delete();
        DB::table('chinhsach')->where('IDKhachSan',$idKS)->delete();
        DB::table('loaiphong')->where('IDKhachSan',$idKS)->delete();
        
       $anh=DB::table('anh')->where('ID',$idKS)->get();
        foreach ($anh as  $item) {
            $location=$item->URL;
            if(File::exists($location)){
                File::delete($location);
            }
        }

        DB::table('anh')->where('ID',$idKS)->delete();

        return redirect()->route('admin.khachsan.danhsach');
    }

    public function gethomepage(){
        $khachsan=DB::table('khachsan')->select('IDKhuVuc')->distinct()->get();
        foreach ($khachsan as $value) {
            $array[]=$value->IDKhuVuc;
        }
        $khuvuc=DB::table('khuvuc')->where('loai',LOCAL)->take(8)->get();
        $khachsanfav=DB::table('khachsan')->orderBy('DanhGia','desc')->take(4)->get();
        $khuvucall=DB::table('khuvuc')->get();
        
        return view('frontendhotel.pages.home',['khuvuc'=>$khuvuc,'khachsanfav'=>$khachsanfav,'khuvucall'=>$khuvucall]);
    }
    public function getlocation($idkv){
        $hop=1;
        $sum=0;
        $loaiphong=DB::table('loaiphong')->get();
        $avg=DB::table('loaiphong')->avg('Gia');
        $final=ceil($avg);
        $number=round($avg,-(strlen($final)-1));
        for($i=0;$i<(strlen($final)-1);$i++){
            $hop*=10;
        }
        $hop1=$hop/2;
        $min=$number-3*$hop1;
        $max=$number+3*$hop1;
        while($min!=$max){
            $array[]=$min+$hop1;
            $min+=$hop1;
        }
        $min=$number-3*$hop1;

        $khachsan=DB::table('khachsan')->where('IDKhuVuc',$idkv)->paginate(12);
        $tienichall=DB::table('chitiettienich')->get();
        $loaikhachsan=DB::table('loaikhachsan')->get();
        $khuvuc=DB::table('khuvuc')->where('IDKhuVuc',$idkv)->get()->first();
        $khuvucall=DB::table('khuvuc')->get();
        return view('frontendhotel.pages.location',compact('khachsan','tienichall','loaikhachsan','min','max','array','khuvuc','khuvucall'));
    }
    public function getlocation1($idkv,$flag,$idloai,$min1,$max1,$idtienich){
         $tienichall=DB::table('chitiettienich')->get();
        $loaikhachsan=DB::table('loaikhachsan')->get();
        $khuvuc=DB::table('khuvuc')->where('IDKhuVuc',$idkv)->get()->first();
        $khachsan=DB::table('khachsan')->where('IDKhuVuc',$idkv)->paginate(12);
        $khuvucall=DB::table('khuvuc')->get();




        if($flag==1){ 
            $khachsan=DB::table('khachsan')->where('IDKhuVuc',$idkv)->orderBy('minprice','desc')->paginate(12);
            if($idloai!=0){
                $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['IDLoaiKhachSan',$idloai]])->orderBy('minprice','desc')->paginate(12);
                if($min1!=0 && $max1==0){
                    $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['IDLoaiKhachSan',$idloai],['minprice','<',$min1]])->orderBy('minprice','desc')->paginate(12);
                }else
                if($min1==0 && $max1!=0){
                    $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['IDLoaiKhachSan',$idloai],['minprice','>=',$max1]])->orderBy('minprice','desc')->paginate(12);
                }else
                 if($min1!=0 && $max1!=0){
                    $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['IDLoaiKhachSan',$idloai],['minprice','>=',$min1],['minprice','<',$max1]])->orderBy('minprice','desc')->paginate(12);
                }
            }
            else {
            if($min1!=0 && $max1==0){
                 $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['minprice','<',$min1]])->orderBy('minprice','desc')->paginate(12);
            }else
            if($max1!=0 && $min1==0){
                $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['minprice','>=',$max1]])->orderBy('minprice','desc')->paginate(12);
            }else
            
            if($max1!=0&&$min1!=0){
                $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['minprice','>=',$min1],['minprice','<',$max1]])->orderBy('minprice','desc')->paginate(12);
               } 
            }
        }else{
            $khachsan=DB::table('khachsan')->where('IDKhuVuc',$idkv)->orderBy('minprice','asc')->paginate(12);
            if($idloai!=0){
                $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['IDLoaiKhachSan',$idloai]])->orderBy('minprice','asc')->paginate(12);
                if($min1!=0 && $max1==0){
                    $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['IDLoaiKhachSan',$idloai],['minprice','<',$min1]])->orderBy('minprice','asc')->paginate(12);
                }else
                if($min1==0 && $max1!=0){
                    $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['IDLoaiKhachSan',$idloai],['minprice','>=',$max1]])->orderBy('minprice','asc')->paginate(12);
                }else
                 if($min1!=0 && $max1!=0){
                    $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['IDLoaiKhachSan',$idloai],['minprice','>=',$min1],['minprice','<',$max1]])->orderBy('minprice','asc')->paginate(12);
                }
            }
            else {
            if($min1!=0 && $max1==0){
                 $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['minprice','<',$min1]])->orderBy('minprice','asc')->paginate(12);
            }
            if($max1!=0 && $min1==0){
                $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['minprice','>=',$max1]])->orderBy('minprice','asc')->paginate(12);
            }
            if($max1!=0&&$min1!=0){
                $khachsan=DB::table('khachsan')->where([['IDKhuVuc',$idkv],['minprice','>=',$min1],['minprice','<',$max1]])->orderBy('minprice','asc')->paginate(12);
                
            }
        }
        }
        $hop=1;
        $sum=0;
        $loaiphong=DB::table('loaiphong')->get();
        $avg=DB::table('loaiphong')->avg('Gia');
        $final=ceil($avg);
        $number=round($avg,-(strlen($final)-1));
        for($i=0;$i<(strlen($final)-1);$i++){
            $hop*=10;
        }
        $hop1=$hop/2;
        $min=$number-3*$hop1;
        $max=$number+3*$hop1;
        while($min!=$max){
            $array[]=$min+$hop1;
            $min+=$hop1;
        }
        $min=$number-3*$hop1;
        return view('frontendhotel.pages.location',compact('khachsan','tienichall','loaikhachsan','min','max','array','khuvuc','khuvucall','idkv','flag','idloai','min1','max1','idtienich'));
    }
    public function gethoteldetail($idks){
        $khachsan=DB::table('khachsan')->where('IDKhachSan',$idks)->get()->first();
        $khuvuc=DB::table('khuvuc')->where('IDKhuVuc',$khachsan->IDKhuVuc)->get()->first();
        $sidehotel=DB::table('khachsan')->where('IDKhuVuc',$khuvuc->IDKhuVuc)->take(5)->get();
        $khuvucall=DB::table('khuvuc')->get();
        return view('frontendhotel.pages.hotel',compact('khachsan','khuvuc','sidehotel','khuvucall'));
    }
    public function getsearch(Request $request){
        $key=$request->keyword;
        $khachsan=DB::table('khachsan')->where('TenKhachSan','Like','%'.$request->keyword.'%')->paginate(6);
        return view('frontendhotel.pages.search',compact('khachsan','key'));
    }
    public function gethotelall($flag,$idloai,$min1,$max1,$idtienich){
         $tienichall=DB::table('chitiettienich')->get();
        $loaikhachsan=DB::table('loaikhachsan')->get();
        $khachsan=DB::table('khachsan')->paginate(9);
        $khuvucall=DB::table('khuvuc')->get();


        if($flag==1){ 
            $khachsan=DB::table('khachsan')->orderBy('minprice','desc')->paginate(12);
            if($idloai!=0){
                $khachsan=DB::table('khachsan')->where([['IDLoaiKhachSan',$idloai]])->orderBy('minprice','desc')->paginate(12);
                if($min1!=0 && $max1==0){
                    $khachsan=DB::table('khachsan')->where([['IDLoaiKhachSan',$idloai],['minprice','<',$min1]])->orderBy('minprice','desc')->paginate(12);
                }else
                if($min1==0 && $max1!=0){
                    $khachsan=DB::table('khachsan')->where([['IDLoaiKhachSan',$idloai],['minprice','>=',$max1]])->orderBy('minprice','desc')->paginate(12);
                }else
                 if($min1!=0 && $max1!=0){
                    $khachsan=DB::table('khachsan')->where([['IDLoaiKhachSan',$idloai],['minprice','>=',$min1],['minprice','<',$max1]])->orderBy('minprice','desc')->paginate(12);
                }
            }
            else {
            if($min1!=0 && $max1==0){
                 $khachsan=DB::table('khachsan')->where([['minprice','<',$min1]])->orderBy('minprice','desc')->paginate(12);
            }else
            if($max1!=0 && $min1==0){
                $khachsan=DB::table('khachsan')->where([['minprice','>=',$max1]])->orderBy('minprice','desc')->paginate(12);
            }else
            
            if($max1!=0&&$min1!=0){
                $khachsan=DB::table('khachsan')->where([['minprice','>=',$min1],['minprice','<',$max1]])->orderBy('minprice','desc')->paginate(12);
               } 
            }
        }else{
            $khachsan=DB::table('khachsan')->orderBy('minprice','asc')->paginate(12);
            if($idloai!=0){
                $khachsan=DB::table('khachsan')->where([['IDLoaiKhachSan',$idloai]])->orderBy('minprice','asc')->paginate(12);
                if($min1!=0 && $max1==0){
                    $khachsan=DB::table('khachsan')->where([['IDLoaiKhachSan',$idloai],['minprice','<',$min1]])->orderBy('minprice','asc')->paginate(12);
                }else
                if($min1==0 && $max1!=0){
                    $khachsan=DB::table('khachsan')->where([['IDLoaiKhachSan',$idloai],['minprice','>=',$max1]])->orderBy('minprice','asc')->paginate(12);
                }else
                 if($min1!=0 && $max1!=0){
                    $khachsan=DB::table('khachsan')->where([['IDLoaiKhachSan',$idloai],['minprice','>=',$min1],['minprice','<',$max1]])->orderBy('minprice','asc')->paginate(12);
                }
            }
            else {
            if($min1!=0 && $max1==0){
                 $khachsan=DB::table('khachsan')->where([['minprice','<',$min1]])->orderBy('minprice','asc')->paginate(12);
            }
            if($max1!=0 && $min1==0){
                $khachsan=DB::table('khachsan')->where([['minprice','>=',$max1]])->orderBy('minprice','asc')->paginate(12);
            }
            if($max1!=0&&$min1!=0){
                $khachsan=DB::table('khachsan')->where([['minprice','>=',$min1],['minprice','<',$max1]])->orderBy('minprice','asc')->paginate(12);
                
            }
        }
        }
        $hop=1;
        $sum=0;
        $loaiphong=DB::table('loaiphong')->get();
        $avg=DB::table('loaiphong')->avg('Gia');
        $final=ceil($avg);
        $number=round($avg,-(strlen($final)-1));
        for($i=0;$i<(strlen($final)-1);$i++){
            $hop*=10;
        }
        $hop1=$hop/2;
        $min=$number-3*$hop1;
        $max=$number+3*$hop1;
        while($min!=$max){
            $array[]=$min+$hop1;
            $min+=$hop1;
        }
        $min=$number-3*$hop1;
        return view('frontendhotel.pages.hotelall',compact('khachsan','tienichall','loaikhachsan','min','max','array','khuvucall','idkv','flag','idloai','min1','max1','idtienich'));
    }

}
