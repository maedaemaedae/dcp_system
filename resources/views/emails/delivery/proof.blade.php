@component('mail::message')
# 📦 Delivery Submitted

A supplier has confirmed the following delivery:

- **Recipient:**  
  {{ optional($delivery->recipient->school)->school_name ?? optional($delivery->recipient->division)->division_name ?? 'N/A' }}

- **Package Code:**  
  {{ optional($delivery->recipient->package->packageType)->package_code ?? 'N/A' }}

- **Quantity:**  
  {{ $delivery->recipient->quantity ?? 'N/A' }}

- **Delivered At:**  
  {{ optional($delivery->updated_at)->format('F j, Y g:i A') ?? 'N/A' }}

@component('mail::button', ['url' => asset('storage/' . $delivery->proof_file)])
View Proof File
@endcomponent

Please verify the details and update the system if necessary.

Thanks,  
{{ config('app.name') }}
@endcomponent
