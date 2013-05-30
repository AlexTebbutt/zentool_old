<?php

class AdminController extends BaseController {

		protected $layout = 'master';
		
	/**
	 * Initializer.
	 *
	 * @return void
	 */
		public function __construct()
		{
			// Apply the  auth filter
			$this->beforeFilter('admin-auth');
		}
		/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    	$organisation = Organisation::all();
    	$organisation->dateTo = date('d-m-Y');
			$tickets = NULL;
    	$this->layout->content = View::make('admin.report', compact('organisation','tickets'));    
    }

	public function getReport()
	{
    $organisation = Organisation::all();
  	$organisation->dateTo = date('d-m-Y');
		$organisation->organisationID = NULL;
		$tickets = NULL;
		$test = NULL;
	
  	$this->layout->content = View::make('admin.report', compact('organisation','tickets'));  		
		
	}
	
	public function postReport()
	{
	
		$test = new stdClass();
		$test->name = "This should work";
 
  	$organisation = Organisation::all();
  	$organisationID = Input::get('organisation-id');
  	$organisation->dateTo = date('d-m-Y');  		
		$organisation->organisationID = $organisationID;
		
		var_dump($test);
  	//Retrieve tickets for organistion
 		if(Input::get('report-type') == 'all')
		{

	  	$tickets = Ticket::where('organisationID', $organisationID)->get();
	  
	  } 
	  elseif (Input::get('report-type') == 'date-range')
	  {

	  	$tickets = Ticket::where('organisationID', $organisationID)->where('updatedAt','>=',date('Y-m-d', strtotime(Input::get('date-from'))))->where('updatedAt','<=',date('Y-m-d', strtotime(Input::get('date-to'))))->get();

	  }  	
/*
  	$queries = DB::getQueryLog();
		$last_query = end($queries);

		var_dump($last_query);
*/

		$this->layout->content = View::make('admin.report', compact('organisation', 'tickets','test')); 
		
	}







    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
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