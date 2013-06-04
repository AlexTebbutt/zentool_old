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
    	//Pretty sure this isn't being used. Remove during tidy up.
    	$organisation = Organisation::all();
    	$organisation->dateTo = date('d-m-Y');
			$tickets = NULL;
    	$this->layout->content = View::make('admin.report', compact('organisation','tickets'));    
    }

		public function getReport()
		{
			//Set up any vars
			$report = new stdClass();
			$report->orgID = Input::get('organisation-id');
			$report->dateTo = date('d-m-Y');
			
			//Get organisations for drop down
			$organisation = Organisation::all();
			
			$data = NULL;
		
	  	$this->layout->content = View::make('reports.adminFull', array('organisation' => $organisation, 'report' => $report, 'data' => $data));		
			
		}
		
		public function postReport()
		{

			//Set up any vars
			$report = new stdClass();
			$report->orgID = Input::get('organisation-id');
			$report->dateTo = date('d-m-Y');
			
			//Get organisations for drop down
			$organisation = Organisation::all();

			//Set up report date ranges
			if (Input::get('report-type') == 'date-range')
			{

				$reportDateFrom = date('Y-m-d', strtotime(Input::get('date-from')));
				$reportDateTo = date('Y-m-d', strtotime(Input::get('date-to')));			

			} else {

				//It's a full report so set date range to first / last ticket date
				$result = Ticket::where('organisationID', $report->orgID)->orderBy('updatedAt')->first(array('updatedAt'));
				$reportDateFrom = date('Y-m-d', strtotime($result->updatedAt));
				$result = Ticket::where('organisationID', $report->orgID)->orderBy('updatedAt','desc')->first(array('updatedAt'));					
				$reportDateTo = date('Y-m-d', strtotime($result->updatedAt));				
				
			}

			$dateFrom = $reportDateFrom;
			$dateTo = date('Y-m-t', strtotime($dateFrom));						


			if ($reportDateTo < $dateTo) 
			{
				$dateRangeTo = $reportDateTo;
			} else {
				$dateRangeTo = date('Y-m-t', strtotime($dateFrom));
			}

			//Loop through tickets month by month, build the ticket section of the report
			$data = NULL;
			$headings = new stdClass();
			
			
			for ($dateRangeFrom = $dateFrom; $dateRangeFrom <= $reportDateTo; )
			{
			
				$headings->count = Ticket::where('organisationID', $report->orgID)->where('organisationID', $report->orgID)->where('updatedAt','>=',$dateRangeFrom)->where('updatedAt','<=',$dateRangeTo . ' 23:59:59')->count();
				
				if ($headings->count > 0)
				{
					$headings->totalTime = Ticket::where('organisationID', $report->orgID)->where('updatedAt','>=',$dateRangeFrom)->where('updatedAt','<=',$dateRangeTo . ' 23:59:59')->sum('time');
					$tickets = Ticket::where('organisationID', $report->orgID)->where('updatedAt','>=',$dateRangeFrom)->where('updatedAt','<=',$dateRangeTo . ' 23:59:59')->get();			
				} else {
					$headings->totalTime = 0;
				}
				
				$headings->monthTitle = date('F', strtotime($dateRangeFrom));				
				$data .= View::make('reports.components.tickets', compact('tickets','headings'));
				$dateRangeFrom = date('Y-m-01', strtotime(date('Y-m-d',strtotime($dateRangeFrom . "+1 month"))));
				$dateRangeTo = date('Y-m-t', strtotime($dateRangeFrom));
				
				if ($dateRangeTo > $reportDateTo) $dateRangeTo = $reportDateTo;
			
			}		
			
	
	
			



			


			


			//Get month time total
			
			//Get total time
			
		
			//Generate view
/*
		  $queries = DB::getQueryLog();
			$last_query = end($queries);
	
			var_dump($last_query);
*/

			$this->layout->content = View::make('reports.adminFull', array('organisation' => $organisation, 'report' => $report, 'data' => $data)); 						
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