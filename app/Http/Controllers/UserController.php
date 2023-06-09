<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;

use App\Models\User;

use Illuminate\Support\Str; 

use Illuminate\Support\Facades\Validator;

use Auth;

use DB;

use Session;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
    public function UserList()
    {
        return view('userList');

    }
   
   
    public function editProfile($id)
    {
        $data =  User::select('*')->where('id',$id)->first();

        return view('editProfile',$data);

    }
   
   
   
    public function updateProfile(Request $request)
    {
        $id = $request->input('id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $name = $first_name.' '.$last_name;
        $old_img = $request->input('old_img');

        if(request()->hasfile('profile_picture')){
            $profile_picture = time().'.'.request()->profile_picture->getClientOriginalExtension();
            request()->profile_picture->move(public_path('images'), $profile_picture);
        }
        else{
            $profile_picture = $old_img;
        }

        $data = array(
            'profile_picture'=>$profile_picture,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'name'=>$name,
        );

        $result = User::where("id", $id)->update($data);
       
        if($result){
            $data['success'] = true;
            $data['message'] ="Profile updated Successfully.";
        }else{
            $data['error'] = true;
            $data['message'] ="Oops something went wrong, Please try again.";
        }

        echo json_encode($data);

    }
   
   
    public function getUserList(Request $request){

        if ($request->ajax()) {

            $data = User::select('*')->orderBy('id', 'DESC')->get();

            return Datatables::of($data)

                ->addIndexColumn()

                ->filter(function ($instance) use ($request) {

                    if (!empty($request->get('search'))) {

                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))){
                                return true;
                            }
                            else if (Str::contains(Str::lower($row['first_name']), Str::lower($request->get('search')))){
                                return true;
                            }
                            else if (Str::contains(Str::lower($row['last_name']), Str::lower($request->get('search')))){
                                return true;
                            }
                            else if (Str::contains(Str::lower($row['email']), Str::lower($request->get('search')))){
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('created_at', function($row){
                    $created_at = date('d-m-y H:i:s',strtotime($row->created_at));
                    return $created_at;
                })

                ->addColumn('profile_picture', function($row){
                    $profile_picture = '<img src="' . asset('images/' . $row->profile_picture) . '" width="50" />';
                    return $profile_picture;
                    
                })
                ->addColumn('qr_code', function($row){
                    $userDetails = array(
                        'id' => $row->id,
                        'first_name' => $row->first_name,
                        'last_name' => $row->last_name,
                        'name' => $row->name,
                        'email' => $row->email,
                        'profile_picture' => $row->profile_picture,
                    );
                    $url = url('editProfile/' . $row->id );

                    $qrCode = QrCode::generate($url) ;
                    // $qrCode = QrCode::generate(json_encode($userDetails));
                    return $qrCode;
                })

                ->addColumn('action', function($row){
                        $url = url('editProfile/' . $row->id );
                        $btn = '<a href="'. $url .'" class="menu-link px-3 mylinkbtn btn-warning" data-kt-users-table-filter="edit_row">Edit</a>';
                        return $btn;
                })
                ->rawColumns(['action','profile_picture','created_at','qr_code'])
                ->make(true);
        }
    }
}