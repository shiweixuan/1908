 <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use DB;
use Validator;
use Illuminate\Validation\Rule;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $res=Db::table('student')->select('*')->get();
        $sname=request()->sname??'';
        $sclass=request()->sclass??'';
        $where=[];
        if($sname){
            $where[]=["sname","like","%$sname%"];                       
        }
        if($sclass){
            $where[]=["sclass","like","%$sclass%"];                       
        }
        $pageSize=config('app.pageSize');
        $res=Student::where($where)->orderby('sid','asc')->paginate($pageSize);

        return view('student.index',['res'=>$res,'sname'=>$sname,'sclass'=>$sclass]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 第一种验证 validate
        $request->validate(
            [
            'sname'=>'unique:student|regex:/^[\x{4e00}-\x{9fa5}A-Za-x0-9]{2,12}$/u',
            'sex'=>'required|integer',
            'score'=>'required|integer|between:0,100',
            ],
            [
                'sname.unique'=>'姓名已存在',
                'sname.regex'=>'姓名不符合规范',
                'sex.required'=>'性别不能为空',
                'sex.integer'=>'性别必须为数字',
                'score.required'=>'成绩不能为空',
                'score.integer'=>'成绩必须为数字',
                'score.between'=>'成绩数据不合法',
            ]
    );

        $data=$request->except('_token');

        //文件上传
        if($request->hasFile('s_img')){
            $data['s_img']=$this->upload('s_img');
        }

        $res=Db::table('student')->insert($data);
        if($res){
            return redirect('/student');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Db::table('student')->where('sid',$id)->first();
        return view('student.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
            // 'sname'=>'unique:student|regex:/^[\x{4e00}-\x{9fa5}A-Za-x0-9]{2,12}$/u',
            'sname'=>[
                    'regex:/^[\x{4e00}-\x{9fa5}A-Za-x0-9]{2,12}$/u',
                    Rule::unique('student')->ignore($id,'sid'),
                ],
            'sex'=>'required|integer',
            'score'=>'required|integer|between:0,100',
            ],
            [
                'sname.unique'=>'姓名已存在',
                'sname.regex'=>'姓名不符合规范',
                'sex.required'=>'性别不能为空',
                'sex.integer'=>'性别必须为数字',
                'score.required'=>'成绩不能为空',
                'score.integer'=>'成绩必须为数字',
                'score.between'=>'成绩数据不合法',
            ]
    );

        $data=$request->except('_token');
        $res=Db::table('student')->where('sid',$id)->update($data);
        if($res!==false){
            return redirect('/student');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Db::table('student')->where('sid',$id)->delete();
        if($res){
            return redirect('/student');
        }
    }
    public function upload($filename){
        //判断上传过程中有无错误
        if(request()->file($filename)->isValid()){
            //接收值
            $photo=request()->file($filename);
            //上传
            $store_result=$photo->store('uploads');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
}
