<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;

class HomeController extends Controller
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
    public function index(Request $request)
    {

        //   $ipToCheck = env('IP_FP');
        //   $port = env('PORT_FP'); 
  
        //   $socket = @fsockopen($ipToCheck, $port, $errno, $errstr, 5);
  
        //   if (!$socket) {
        //     //   return response('IP address is not connected', 404);
        //     $users = [];
        //     return view('home',compact('users'));

        //   }
  
        //   fclose($socket);

        // //   return response('IP address is connected', 200);

          $users = [];

          return view('home',compact('users'));


        // $clientIp = $request->server('REMOTE_ADDR');

        // if ($clientIp !== $this->allowedIp) {
        //     return response('Unauthorized', 403);
        // }

        // // Handle the WebSocket connection using php-websocket
        // $server = new WebSocketServer("127.0.0.1", 8080);
        // $server->socketCreate();
        // $server->socketListen();

        // while (true) {
        //     $client = $server->socketAccept();
        //     if ($client !== false) {
        //         // Handle the WebSocket connection here
        //         // You can add your custom logic to communicate with the client
        //     }
        // }


            //    $zk = new ZKTeco("192.168.1.10",4370);
            //     if($zk){
            //         $zk->connect();  
            //         $attend = $zk->getAttendance();
            //         $zk->disconnect();   

            //         dd($attend);
            //     }

            //   dd('dah');



        // $ipAddress = '192.168.1.10';
        // $port = 4370;


        // $allowedIp = '192.168.1.10'; // Replace with the IP address you want to allow

        // // Get the IP address of the incoming request
        // $clientIp = $request->ip();

        // // Check if the client IP matches the allowed IP
        // if ($clientIp !== $allowedIp) {
        //     return response('Unauthorized', 403);
        // }

        // // IP is allowed, perform your controller logic here
        // // For example, return a response
        // return response('Access granted');
        
        // try {
        //     $zk = new ZKTeco($ipAddress, $port);
        //     $con = $zk->connect();
            
        //     if ($con) {
        //         // Successfully connected to the ZKTeco device
        //         // You can proceed with further actions here
        //     } else {
        //         // Connection was established but unsuccessful
        //         // Handle the specific case of an unsuccessful connection
        //         echo "Connection to $ipAddress:$port was unsuccessful.";
        //     }
        // } catch (Exception $e) {
        //     // Handle the exception when the connection is actively refused
        //     echo "Error: " . $e->getMessage();
        // }
      

       
        
        // try {
        //     $zk = new ZKTeco($ipAddress, $port);
        //     $con = $zk->connect();
            
        //     if ($con) {
        //         // Successfully connected to the ZKTeco device
        //         // You can perform further actions here
        //     } else {
        //         // Failed to connect to the ZKTeco device
        //         echo "Failed to connect to $ipAddress:$port";
        //     }
        // } catch (Exception $e) {
        //     // Handle any exceptions that may occur during connection
        //     echo "Error: " . $e->getMessage();
        // }

      



        // new ZKLib("192.168.1.10",4370);
        // $attendance = [];
        // // $zk = new ZktecoLib("192.168.1.10",4370);
        // // if ($zk->connect()){
        // //     $attendance = $zk->getAttendance();
        // //     // return view('zkteco::app',compact('attendance'));
        // //     return view('home',compact('attendance'));
        // // }

        // // $zk = new ZKTeco("192.168.1.10",4370);
        // // $zk->connect();  
        // // $attend = $zk->getAttendance();
        // // $zk->disconnect();   

        // // dd($attend);

    //     $zk = new ZKTeco('192.168.1.10');

    //    $con =  $zk->connect();


    // $ipAddress = '192.168.1.10';
    // $port = 4370; // ZKTeco devices typically use port 4370, but check your device's documentation for the correct port.

    // // Create a socket connection
    // $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    // if ($socket === false) {
    //     die("Unable to create socket: " . socket_strerror(socket_last_error()));
    //     dd('ddd');
    // }


        // dd($con);


        // if ($con == true) {
        
        //     // Connected successfully
        //     $users = $zk->getUser(); // Replace with the appropriate method to fetch data

        //     $zk->disconnect(); // Disconnect after use

        //     return view('home',compact('users'));
        //     // return response()->json($users);
        // } else {
        //     return response()->json(['error' => 'Could not connect to the device']);
        // }

        // $users = [];

        // return view('home',compact('users'));

        // return view('home',compact('attendance'));


       
        // set_time_limit(30);

        // $zk = new ZKTeco('192.168.1.10', 4370); 

        // if ($zk->connect()) {

        //     $zk->disconnect();
        //     dd('yy');
        // } else {
        //     dd('ddd');
        //     // return redirect()->route('create-user')->with('error', 'Could not connect to the device');
        // }



    }
}
