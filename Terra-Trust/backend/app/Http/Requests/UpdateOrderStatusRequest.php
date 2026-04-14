namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize()
    {
        $order = $this->route('order');
        $useer = $this->user();
        $status = $this->input('status');

        //权限控制
        if($user->role === 'consumer' && in_array($status,['completed']))
        {
            return $order->consumer_id === $user->id;
        }
        if($user->role === 'purchaser' && in_array($status,['shipped']))
        {
            return $order->purchaser_id === $user->id;
        }
        return false;
    }
    
    public function rules()
    {
        return [
             'status' => 'required|string|in:pending,accepted,shipped,completed,cancelled',
        ];
    }
}