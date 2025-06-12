<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;


class UpdateScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'movie_id' => ['required'],
            'start_time_date' => ['required', 'date_format:Y-m-d', 'before_or_equal:end_time_date'],
            'start_time_time' => ['required', 'date_format:H:i'],
            'end_time_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:start_time_date'],
            'end_time_time' => ['required', 'date_format:H:i'],
        ];
    }

    public function withValidator(Validator $validator):void
    {
        $validator->after(function (Validator $validator){
            try {
                $start_time = new Carbon($this->input('start_time_date') . ' ' . $this->input('start_time_time'));
                $end_time = new Carbon($this->input('end_time_date') . ' ' . $this->input('end_time_time'));
                if ($start_time >= $end_time) {
                    $validator->errors()->add('start_time_time', '開始時刻が終了時刻より後または同じです');
                    $validator->errors()->add('end_time_time','開始時刻が終了時刻より後');
                } elseif ($start_time->diffInMinutes($end_time) <= 5) {
                    $validator->errors()->add('start_time_time', '上映時間は5分以上必要です');
                    $validator->errors()->add('end_time_time','開始時刻が終了時刻より後');
                }
            } catch (\Exception $e) {
                $validator->errors()->add('start_time_time','フォーマットが正しくありません');
            }
        });
    }
}
