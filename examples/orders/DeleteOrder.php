

use Thiio\ActiveCampaign\ActiveCampaign;
use Thiio\ActiveCampaign\models\ActiveCampaignCustomer;
use Thiio\ActiveCampaign\models\ActiveCampaignOrder;
use Thiio\ActiveCampaign\models\ActiveCampaignOrderDiscount;
use Thiio\ActiveCampaign\models\ActiveCampaignOrderProduct;

$url = "<https://YOUR_USER.api-us1.com>";
$key = "<YOUR_TOKEN_KEY>";

$client = new ActiveCampaign();
$client->initialize($url, $key);

$orders = $client->orders();

try{
    $response = $orders->delete(3);
    if($response->success){
        echo "Order successfully deleted \n";
    }else{
        if( isset($response->body->message) ){
            $response->body->message;
        }
        if( isset($response->body->errors) ){
            foreach($response->body->errors as $error){
                echo $error->title."\n";
                echo $error->detail."\n";
                echo $error->code."\n";
            }
        }
    }
}catch(Exception $e){
    echo $e->getMessage();
}