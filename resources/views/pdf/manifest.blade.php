<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Manifestf on {{ $date }}</title>
    <link href="/fonts/inter/inter.css" rel="stylesheet" type="text/css" />
    @include('pdf.style')
</head>

<body>
    <div>
        <table class="w-full max-w-full divide-y divide-slate-300">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="py-2 pl-4 pr-3 text-sm font-semibold text-left text-slate-900 sm:pl-6">
                        Check-in
                    </th>
                    <th scope="col" class="px-3 py-2 text-sm font-semibold text-left text-slate-900">
                        Customer
                    </th>
                    <th scope="col" class="px-3 py-2 text-sm font-semibold text-center text-slate-900">
                        Adult
                    </th>
                    <th scope="col" class="px-3 py-2 text-sm font-semibold text-center text-slate-900">
                        Child
                    </th>
                    <th scope="col" class="px-3 py-2 text-sm font-semibold text-left text-slate-900">
                        Guide
                    </th>
                    <th scope="col" class="px-3 py-2 text-sm font-semibold text-left text-slate-900">
                        Email
                    </th>
                    <th scope="col" class="px-3 py-2 text-sm font-semibold text-left text-slate-900">
                        Notes
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @foreach ($data as $key => $code)
                <tr>
                    <td scope="col" colspan="2" class="py-2 pl-4 pr-3 text-sm font-medium text-slate-900 whitespace-nowrap sm:pl-6 bg-slate-50">
                        {{ $key }}
                    </td>
                    <td class="px-3 py-2 text-sm font-medium text-center text-slate-900 whitespace-nowrap bg-slate-50">
                        {{ array_sum(Arr::pluck($code, 'adult')) }}
                    </td>
                    <td class="px-3 py-2 text-sm font-medium text-center text-slate-900 whitespace-nowrap bg-slate-50">
                        {{ array_sum(Arr::pluck($code, 'child')) }}
                    </td>
                    <td colspan="3" class="px-3 py-2 text-sm font-medium text-slate-900 whitespace-nowrap sm:pl-6 bg-slate-50"></td>
                </tr>
                @foreach ($code as $item)
                <tr class="group hover:bg-slate-50">
                    <td class="py-2 pl-4 pr-3 text-sm font-medium text-slate-900 whitespace-nowrap sm:pl-6">
                        {{ $item['check_in'] }}
                    </td>
                    <td class="px-3 py-2 text-sm text-slate-500 whitespace-nowrap">
                        <span class="uppercase">{{ $item['last_name'] }}</span>,
                        {{ $item['first_name'] }}
                    </td>
                    <td class="px-3 py-2 text-sm text-center text-slate-500 whitespace-nowrap">
                        {{ $item['adult'] }}
                    </td>
                    <td class="px-3 py-2 text-sm text-center text-slate-500 whitespace-nowrap">
                        {{ $item['child'] }}
                    </td>
                    <td class="px-3 py-2 text-sm text-center text-slate-500 whitespace-nowrap">
                        {{ $item['guide'] }}
                    </td>
                    <td class="px-3 py-2 text-sm text-left text-slate-500 whitespace-nowrap">
                        {{ $item['email'] }}
                    </td>
                    <td class="px-3 py-2 text-sm text-left text-slate-500">
                        {{ $item['note'] }}
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
