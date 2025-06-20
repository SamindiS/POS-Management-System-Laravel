<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'supplier_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|size:2',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'tax_id' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'is_active' => 'required|boolean',
        ];
        
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $supplier = $this->route('supplier');
            $rules['email'] .= '|unique:suppliers,email,'.$supplier->id;
        } else {
            $rules['email'] .= '|unique:suppliers,email';
        }
        
        return $rules;
    }
    
    public function messages()
    {
        return [
            'supplier_name.required' => 'The supplier name field is required.',
            'phone.required' => 'The phone number field is required.',
            'email.unique' => 'This email address is already in use by another supplier.',
        ];
    }
}