<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="20">
                Report Date: &nbsp; &nbsp;
                {{ $from_date }} to {{ $to_date }}
            </th>
        </tr>
        <tr>
            <th>Teacher</th>
            @foreach ($selectedBatches as $batch)
                <th>{{ $batch->name }}</th>
            @endforeach
            <th>
                Total
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            $batch_class_count = [];
        @endphp
        @foreach ($teacherBatchRoutine as $teacher => $routines)
            @php
                $horizontalTotal = 0;
            @endphp
            <tr>
                <th>
                    {{ $teacher }}
                </th>
                @foreach ($selectedBatches as $batch)
                    <td>
                        @if (isset($routines[$batch->name]))
                            {{ $routines[$batch->name] }}
                            @php
                                $horizontalTotal += $routines[$batch->name];
                                if(isset($batch_class_count[$batch->name])){
                                    $batch_class_count[$batch->name] += $routines[$batch->name];
                                }else{
                                    $batch_class_count[$batch->name] = $routines[$batch->name];
                                }
                            @endphp
                        @else
                            0
                        @endif
                    </td>
                @endforeach
                <td>
                    {{ $horizontalTotal }}
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            @foreach ($selectedBatches as $batch)
                <th>
                    {{ $batch_class_count[$batch->name] ?? '0' }}
                </th>
            @endforeach
        </tr>
    </tfoot>
</table>
