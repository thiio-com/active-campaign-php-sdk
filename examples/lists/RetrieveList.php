use Thiio\ActiveCampaign\ActiveCampaign;
use Thiio\ActiveCampaign\models\ActiveCampaignList;


$url = "<https://YOUR_USER.api-us1.com>";
$key = "<YOUR_TOKEN_KEY>";

$client = new ActiveCampaign();
$client->initialize($url, $key);

$lists = $client->lists();
try{
    $listId = 4;
    $response = $lists->retrieve($listId);
    
    if($response->success){
        echo "List found \n";
        var_dump($response->body->list);
    }else{
        if(isset($response->body->message)){
            echo $response->body->message."\n";
        }
        if(isset($response->body->error)){
            echo $response->body->error."\n";
        }
    }
}catch(Exception $e){
    echo $e->getMessage();
}