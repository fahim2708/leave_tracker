<x-mail::message>
# Leave Request

Hello {{$employee->name}},<br>
Your leave request has been submitted successfully. Here are the details:<br>
- **Start Date:** {{ $data->start_date->format('d-m-Y') }}
- **End Date:** {{ $data->end_date->format('d-m-Y') }}
- **Total Leave Days:** {{ $data->total_leave_days }}


{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{'Leave Tracker'}}
{{-- {{ config('app.name') }} --}}
</x-mail::message>
