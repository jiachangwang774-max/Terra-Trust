namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->role === 'consumer';
    }

    public function rules()
    {
        return [
            'shippinf_address' => 'required|string',
            'items' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }
}