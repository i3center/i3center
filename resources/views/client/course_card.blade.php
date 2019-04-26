<a href="{{ URL::asset("/i3class/$i3class->id") }}" class="text-dark text-decoration-none">
    <div class="card shadow-sm rounded text-center p-3 h-100 bg-white hover-danger {{ $i3class->course->special == true ? 'border-danger' : '' }}">
        @if($i3class->course->special == true)
            <div class="col-2 p-0 special-course">
                <img src="/photos/1/i3logo.png" class="img-fluid hover-image">
                <b class="text-danger">Pack</b>
            </div>
        @endif
        <img src="{{ URL::asset($i3class->course->image) }}"
             class="img-fluid mx-auto w-50 hover-image" alt="{{$i3class->course->name}}">
        <div class="card-body p-0">
            <h5 class="card-title mt-3">{{$i3class->course->name}}</h5>
            <p class="card-text text-wrap small">{{ $i3class->course->description }}</p>
        </div>
        <div class="card-footer border-0 bg-transparent p-0 mt-2">
            <ul class="list-unstyled text-right mb-0">
                <li class="small">
                    <i class="fas fa-user fa-fw text-danger"></i>
                    {{ $i3class->teacher->name }}
                </li>
                <li class="small">
                    <i class="fas fa-calendar-check fa-fw text-danger"></i>
                    از {{ $i3class->start_date }}
                </li>
                <li class="small">
                    <i class="fas fa-calendar-week fa-fw text-danger"></i>
                    {{ $i3class->weekdays }}
                </li>
                <li class="small">
                    <i class="fas fa-clock fa-fw text-danger"></i>
                    {{ $i3class->start_time }}
                    تا
                    {{ $i3class->end_time }}
                </li>
            </ul>
        </div>
    </div>
</a>
