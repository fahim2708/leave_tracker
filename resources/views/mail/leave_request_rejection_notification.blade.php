<x-mail::message>
# Leave Request Rejected

Hello {{$employee->name}},<br>
Your leave request has been rejected by admin. Here are the details:<br>
- **Start Date:** {{ $leave->start_date->format('d-m-Y') }}
- **End Date:** {{ $leave->end_date->format('d-m-Y') }}
- **Total Leave Days:** {{ $leave->total_leave_days }}
- **Remarks by Admin:** {{ $leave->remark }}

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{'Leave Tracker'}}
{{-- {{ config('app.name') }} --}}
</x-mail::message>
