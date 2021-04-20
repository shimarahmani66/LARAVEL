<?php

namespace App\lib;
use Illuminate\Support\Facades\DB;

/**
 * This is just an example.
 */
class Mellat_Bank
{
    public $TerminalId;
    public $UserName;
    public $Password;
    public function __construct()
    {

        $this->TerminalId=$this->get_setting('terminalid');
        $this->UserName=$this->get_setting('username');
        $this->Password=$this->get_setting('password');

    }
    public function get_setting($option_name)
    {
        $setting=DB::table('settings')->where('option_name',$option_name)->first();
        if($setting)
        {
            return $setting->option_value;
        }
        else
        {
            return '';
        }
    }

    public function pay($amount)
    {
        $client = new \nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
        $namespace='http://interfaces.core.sw.bps.com/';
        $error = $client->getError();
        if($error)
        {
            return false;
        }
        $parameters = array(
            'terminalId' =>$this->TerminalId,
            'userName' =>$this->UserName,
            'userPassword' =>$this->Password,
            'orderId' =>time(),
            'amount' => $amount,
            'localDate' =>date("Ymd"),
            'localTime' =>date("His"),
            'additionalData' =>'خرید',
            'callBackUrl' =>'http://localhost:81/laravel-shop/public/orders',
            'payerId' =>0
        );
        $result = $client->call('bpPayRequest', $parameters, $namespace);
        $res=@explode(',',$result);
        if(sizeof($res)==2)
        {
            if($res[0]==0)
            {
                return $res[1];
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    public function Verify($SaleOrderId,$SaleReferenceId)
    {
        $client =new \nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
        $namespace='http://interfaces.core.sw.bps.com/';
        $error = $client->getError();
        if($error)
        {
            return false;
        }
        $parameters = array
        (
            'terminalId' =>$this->TerminalId,
            'userName' =>$this->UserName,
            'userPassword' =>$this->Password,
            'orderId' => $SaleOrderId,
            'saleOrderId' => $SaleOrderId,
            'saleReferenceId' => $SaleReferenceId
        );
        $VerifyAnswer = $client->call('bpVerifyRequest', $parameters,$namespace);
        if($VerifyAnswer==0)
        {
            $result=$client->call('bpSettleRequest', $parameters,$namespace);
            return true;
        }
        else
        {
            $this->Inquiry($SaleOrderId,$SaleReferenceId);
        }
    }
    public function Inquiry($SaleOrderId,$SaleReferenceId)
    {
        $client =new \nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
        $namespace='http://interfaces.core.sw.bps.com/';
        $error = $client->getError();
        if($error)
        {
            return false;
        }
        $parameters = array
        (
            'terminalId' =>$this->TerminalId,
            'userName' =>$this->UserName,
            'userPassword' =>$this->Password,
            'orderId' => $SaleOrderId,
            'saleOrderId' => $SaleOrderId,
            'saleReferenceId' => $SaleReferenceId
        );
        $Inquiry = $client->call('bpInquiryRequest', $parameters,$namespace);
        if($Inquiry==0)
        {
            $result=$client->call('bpSettleRequest', $parameters,$namespace);
            return true;
        }
        else
        {
            $result=$client->call('bpReversalRequest', $parameters,$namespace);
            return false;
        }
    }
}
