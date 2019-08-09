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



use Illuminate\Validation\Validator;

class CompanyController extends Controller
{
    

protected $sparkpost;
public function __construct(sparkpost $sparkpost) {
       $this->sparkpost = $sparkpost;
      //'64dc3fe87a67f491f0fcd28984c33ac965a2e407'
       $this->middleware('auth');
       $this->sparkpost->api_token='64dc3fe87a67f491f0fcd28984c33ac965a2e407';
   }


    /**
     * Display a listing of the resource.
     * 
     * @return Response
     */
    public function index()
    {
        //
        $user_id =  Auth::user()->id;
            $company =User::where('id',$user_id)             
               ->first();   
                $clients =client::where('user_id',$user_id)->get();  
                $campaign = campaign::all();           
         

     
          // return $clients;
        //return view('client.createcompany',['company' => 'company'];
     return view('client.index',['company'=> $company,'clients'=>$clients,'campaign'=>$campaign]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

       




    public function create()
    {
        //Happy#?

        return view('client.createcompany');
    }

     


    public function createcampign(Request $request)
    {





foreach ($request->emails as $emails_id){

    $sentdate = $request->start_date.' '.$request->start_time;
  $client = client::find($emails_id);  
      $client->sentdate = $sentdate;
      

  $client->campaign_id = $request->campagin;
  $client->save();

}

        return redirect('/')->with('status_emails', 'Thank you Emails will be scheduel after authorisation by Admin'.$request->Client_name);
    }






      /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function editDetails(Request $request)
    {
        //edit details of the company 
   
       // $client = company::find($request->id);
                        
       //  $client->name = $request->name;  
       //  $client->type = $request->type;         
       //  $client->save();
      return redirect('/')->with('status_edit', 'Your Details Have beed edited');
      
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
          $client->user_id = Auth::user()->id;        
         $client->name = $request->Client_name;  
         $client->email = $request->Client_email;         
         $client->save();
        return redirect('/')->with('status_client', 'Client added '.$request->Client_name);
      
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
      $names = trim(str_replace(" ","_",$request->campaign_name));
         $campaign = new campaign;  

         $campaign->name = $names; 
          $campaign->user_id =Auth::user()->id;  
         /*
        added later
         $campaign->startdate = $request->start_date; 
         $campaign->startime = $request->start_time;     

         */    
         $campaign->save();
        return redirect('/')->with('status_campaign', 'New campaign added '.$request->campaign_name);
      
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
         $names = str_replace(" ","_",$request->name);
         $company = new company; 
         $company->name = $names;
         $company->type = $request->type;         
         $company->save();
        return redirect('/addcomapny');
        
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function deleteemails($id)   
    {
      ;
        $client = client::find($id);
                        
         $client->user_id = 0; 
            
         $client->save();


        return redirect('/')->with('status_deemail', 'Email Delited ');
    }

  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //#214294
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
