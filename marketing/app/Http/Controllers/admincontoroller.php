<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customs\sparkpost;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\client;
use App\campaign;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class admincontoroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(sparkpost $sparkpost) {
       $this->sparkpost = $sparkpost;
      //'64dc3fe87a67f491f0fcd28984c33ac965a2e407'
       $this->middleware('auth');
     //  $this->sparkpost->api_token='';
       
      

   }


    public function index()
    {
        //
                          
               $comapign = campaign::all();
               $user= User::all();              
                   
                $clients =client::all();        
             
          // return $clients;
        //return view('client.createcompany',['company' => 'company'];
     return view('admins.index',['company'=> $user,'campagin'=>$comapign,'clients'=>$clients]);
    }

    public function viewcomapny($id)
    {
        //
               $company =  User::where('id',$id)->first();             
               $comapign = campaign::all();       
               $clients =  client::where('user_id',$id)->orWhere('user_id',0)->orderBy('user_id', 'desc')->get();        
             
          // return $clients;
        //return view('client.createcompany',['company' => 'company'];
           // return $comapign->id;
     return view('admins.viewcompany',['company'=> $company,'campagin'=>$comapign,'clients'=>$clients]);
    }


   /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeNewcompany(Request $request)
    {
        //
         $names = str_replace(" ","_",$request->name);
         $company = new company; 
         $company->name = $names;
         $company->type = $request->type;         
         $company->save();
        return redirect('/');
        
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function addkey(Request $request)
    {
        //
           $id = Auth::user()->id;
         $campaign = user::find($id);          
         $campaign->mykey  = $request->key;       
         
         $campaign->save();
       return redirect('/viewcomapny/'.$id)->with('status_campaign', 'New campaign added '.$request->campaign_name);
      
    }



       /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function campaignstore(Request $request)
    {
        //
      
         $campaign = new campaign; 
         $campaign->user_id = 0;        

         $campaign->name = $request->campaign_name;       
          
         $campaign->save();
        return redirect('/admins')->with('status_campaign', 'New campaign added '.$request->campaign_name);
      
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeclient(Request $request)
    {
        //
     
         $client = new client; 
          $client->user_id = 0;         
         $client->name = $request->Client_name;  
         $client->email = $request->Client_email; 
         $client->type = $request->type;         
         $client->save();
        return redirect('/admins')->with('status_client', 'Client added '.$request->Client_name);
      
    }

    public function destroy_campaign($id)
    {
        //
     
         campaign::destroy($id);
         return redirect('/admins')->with('status_client', 'Client added ');
      
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function authorized($id)
    {
        //
  

           
           
        $client = company::find($id);
                        
         $client->autho = 1;  
             
         $client->save();
      return redirect('/viewcomapny/'.$id)->with('status_edit', 'Your Details Have beed edited');
      
    }

     public function setmykey(){

        $mykey =  User::find(3);  
        $keys = $mykey->mykey;
        if($keys){
            $this->sparkpost->api_token = $keys;
           

        }
       
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function roles($id)
    {
        //
 $user = User::find($id);
    //$role = Role::create(['name' => 'admin']);
       //return $user; 
    $user->assignRole('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

     public function createlist(Request $request){
        

      
     
    $this->sparkpost->api_token = $request->user_id;
           
echo $keys;

        $url ='/recipient-lists?num_rcpt_errors=3';
        $msg = array('id'=>trim($request->campagin),
                   'name'=>trim($request->campagin),      
              'recipients' => array()
            );
          
        foreach ($request->emails as $emails){
        $item = explode('_',$emails);       
        $recipient = array_push($msg['recipients'],array('address' => $item[1],'name'=>$item[0]));        
        }
        $msg = json_encode($msg);
         $recipient = $this->sparkpost->sp_create($url, $msg);
        dd($recipient);
        
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
