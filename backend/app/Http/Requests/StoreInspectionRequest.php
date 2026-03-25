namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInspectionRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->role === 'purchaser';
    }

    public function rules()
    {
        return [
            'order_id' => 'required|integer|exists:orders,id',
            'result' => 'required|string|in:qualified,unqualified',
            'inspection_time' => 'required|date_format:Y-m-d H:i:s',
            'remarks' => 'nullable|string',    
        ];
    }
}