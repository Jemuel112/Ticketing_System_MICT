<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketFormRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if(Auth::user()->department == 'Administrator' || Auth::user()->department == 'MICT'){
            if ($request->category == 'System'){
                    $data = request()->validate([
                        'sys_category' => 'required',
                    ],[
                        'sys_category.required' => 'is required'
                    ]);
            }
        }

        if (Auth::user()->department == 'Administrator') {
            if ($request->status == 'On-Going') {
                return [
                    $data = request()->validate([
                        'og_status' => 'required',
                        'start_at' => 'required',
                        'end_at' => 'required',
                        'reported_by' => 'required',
                        'request_by' => 'required',
                        'acknowledge_by' => 'required',
                        'status' => 'required',
                        'category' => 'required',
                        'concerns' => 'required|min:8',
                        'lop' => 'required',
                    ], [
                        'og_status.required' => 'is required',
                        'start_at.required' => 'is required',
                        'end_at.required' => 'is required',
                        'reported_by.required' => 'is required',
                        'request_by.required' => 'is required',
                        'acknowledge_by.required' => 'is required',
                        'status.required' => 'is required',
                        'category.required' => 'is required',
                        'concerns.required' => 'is required',
                        'concerns.min' => 'must be at least 8 characters',
                        'lop.required' => 'is required',
                    ])];
            } else {
                return [
                    $data = request()->validate([
                        'reported_by' => 'required',
                        'request_by' => 'required',
                        'acknowledge_by' => 'required',
                        'status' => 'required',
                        'category' => 'required',
                        'concerns' => 'required|min:8',
                        'lop' => 'required',
                    ], [
                        'reported_by.required' => 'is required',
                        'request_by.required' => 'is required',
                        'acknowledge_by.required' => 'is required',
                        'status.required' => 'is required',
                        'category.required' => 'is required',
                        'concerns.required' => 'is required',
                        'concerns.min' => 'must be at least 8 characters',
                        'lop.required' => 'is required',
                    ])];
            }
        } elseif (Auth::user()->department == 'MICT') {
            if ($request->status == 'On-Going') {
                return [
                    $data = request()->validate([
                        'og_status' => 'required',
                        'start_at' => 'required',
                        'end_at' => 'required',
                        'reported_by' => 'required',
                        'request_by' => 'required',
                        'acknowledge_by' => 'required',
                        'status' => 'required',
                        'category' => 'required',
                        'concerns' => 'required|min:8',
                        'lop' => 'required',
                    ], [
                        'og_status.required' => 'is required',
                        'start_at.required' => 'is required',
                        'end_at.required' => 'is required',
                        'reported_by.required' => 'is required',
                        'request_by.required' => 'is required',
                        'acknowledge_by.required' => 'is required',
                        'status.required' => 'is required',
                        'category.required' => 'is required',
                        'concerns.required' => 'is required',
                        'concerns.min' => 'must be at least 8 characters',
                        'lop.required' => 'is required',
                    ])];
            } else {
                return [
                    $data = request()->validate([
                        'reported_by' => 'required',
                        'request_by' => 'required',
                        'status' => 'required',
                        'acknowledge_by' => 'required',
                        'category' => 'required',
                        'concerns' => 'required|min:8',
                        'lop' => 'required',
                    ], [
                        'reported_by.required' => 'is required',
                        'request_by.required' => 'is required',
                        'acknowledge_by.required' => 'is required',
                        'status.required' => 'is required',
                        'category.required' => 'is required',
                        'concerns.required' => 'is required',
                        'concerns.min' => 'must be at least 8 characters',
                        'lop.required' => 'is required',
                    ])];
            }
        } else {
            return [
                $data = request()->validate([
                    'reported_by' => 'required',
                    'request_by' => 'required',
                    'status' => 'required',
                    'category' => 'required',
                    'concerns' => 'required|min:8',
                ], [
                    'reported_by.required' => 'is required',
                    'request_by.required' => 'is required',
                    'status.required' => 'is required',
                    'category.required' => 'is required',
                    'concerns.required' => 'is required',
                    'concerns.min' => 'must be at least 8 characters',
                ])];
        }
    }


}
