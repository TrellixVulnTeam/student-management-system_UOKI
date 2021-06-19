@extends('layouts.hwpl')
    <div id="upload-documents" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <strong>Upload Profile Documents</strong>
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{asset('new/node_modules/@coreui/icons/sprites/free.svg#cil-x')}}"></use>
                    </svg>
                    </button>
                </div>
                {!! Form::open(array('url' => '/profiles/documents', 'method' => 'post', 'class'=> 'form-vertical form-material', 'enctype="multipart/form-data"')) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('description', 'Description')}}
                                {{Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Type here'])}}
                                {{Form::hidden('profile', $profile->slug, ['class' => 'form-control', 'placeholder' => 'Type here'])}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('document', 'Select file')}}
                                {{Form::file('document', null, ['class' => 'form-control'])}}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect">Upload</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->

        </div>
    </div>

@section('breadcrumb')
<div class="c-subheader px-3">
    <!-- Breadcrumb-->
    <ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item">Management</li>
    <li class="breadcrumb-item"><a href="/profiles">Profiles </a></li>
    <li class="breadcrumb-item active">Show</li>
    <!-- Breadcrumb Menu-->
    </ol>
</div>
@endsection

@section('content')
<script type="text/javascript">
    function myFunction(profile) {
    var myWindow = window.open("/profile/print/" + profile, "", "width=auto,height=auto");
    }
</script>
<div class="row">
    <div class="col-md-3 col-xs-12">
        <div class="card">
            <div class="card-header">
                <strong>Quick actions</strong>
            </div>
            <div class="card-body">
                {{($profile->profile_organization)}}
                <ul>
                    <li><a href="/meetings/create/{{$profile->slug}}">New meeting report</a> <br></li>
                    <li><a href="/calls/create/{{$profile->slug}}">New call report</a></li>
                    <li><a href="/emails/create/{{$profile->slug}}">New email report</a></li>
                    <li><a href="/messages/create/{{$profile->slug}}">New message report</a></li>
                    <li><a href="/media-coverage/create/{{$profile->slug}}">New media coverage report</a></li>
                    <li><a href="#upload-documents" data-toggle="modal" data-target="#upload-documents">Upload Profile Document</a></li>
                    <li><a href="/profiles/{{$profile->slug}}/edit">Update Profile</a></li>
                    <li><a href="#" onclick="myFunction('{{$profile->slug}}')">Print Profile</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-xs-12">
        <div class="card">
            <div class="card-header">
                <strong>{{$profile->fullname}} {{$profile->lastname}} </strong> | <a href="/profiles/{{$profile->slug}}/edit">Update Profile</a>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs tabcontent-border" role="tablist" id="profiles-tab">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#activity-timeline" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Activities</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#events-attended" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Events</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#documents" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Documents</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#about" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">About</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#contacts" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Contact</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#relationship" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Relationship</span></a> </li>
                </ul>
                <div class="tab-content tabcontent-border">
                    <div class="tab-pane active p-2" id="activity-timeline" role="tabpanel">
                            @forelse($profile->activities as $activity)
                                <span class="text-uppercase pb-1">
                                    <strong><mark>{{$activity->activity_type->name}} Report</mark></strong> 
                                </span> | <a href="/activities/{{$activity->activity_type->name}}/{{$activity->id}}/{{$profile->slug}}/edit">Update report</a>
                                <p>
                                    @if($activity->activity_type->name != "Meeting")
                                    <strong>Direction:</strong> {{$activity->direction}} <br>
                                    @else
                                    <strong>Type:</strong> {{$activity->meeting_type}} <br>
                                    @endif
                                    @if($activity->activity_type->name == "Meeting")
                                    <strong>Where:</strong> {{$activity->venue}} <br>
                                    @endif
                                    <strong>Staff:</strong> @foreach($activity->users as $rep) {{$rep->name}}, @endforeach<br>
                                    <strong>When:</strong> {{$activity->when}} {{$activity->time}} <br>
                                    <strong>Why</strong>  <br>{{$activity->why}}<br> <br>
                                    <strong>Outcome</strong>  <br>{{$activity->outcome}}
                                </p>
                                    @forelse($activity->photos->where('profile_id', $profile->id) as $photo)
                                    <a href="{{ url('storage/'.$photo->path) }}" target="_blank" data-toggle="lightbox" data-effect="mfp-zoom-in" data-gallery="multiimages" data-title="{{$photo->caption}}">
                                        <img src="{{ url('storage/'.$photo->path) }}" alt="{{$photo->caption}}" class="all studio col-md-3 col-xs-12" style="background-color: rgba(245, 245, 245, 0.5); padding: 5px; border-radius: 5px;" />
                                    </a>
                                    @empty
                                    <mark><em>This report does not have any photos</em></mark>
                                    @endforelse
                                <br>
                                <span class="text-center">
                                    <em>The End</em>
                                </span>
                                <hr>
                            @empty
                                No activities recorded for this profile.
                            @endforelse
                    </div>
                    <div class="tab-pane  p-4 b-r b-l" id="events-attended" role="tabpanel">
                        @forelse($profile->events as $event)
                        <h5 class="card-title text-uppercase mb-0"><strong>{{$event->name}}: <i>{{$event->theme}}</i></strong></h5>
                        <hr>
                        <p>
                            <strong>Event Type:</strong> {{$event->event_type}}<br>
                            <strong>Start Date:</strong> {{$event->start_date}} {{$event->start_time}} <br>
                            <strong>End Date:</strong> {{$event->end_date}} {{$event->end_time}} <br>
                            <strong>Where: </strong>  <br>{{$event->address_line1}}<br> {{$event->address_line2}}<br>
                            <strong>Description</strong>  <br>{{$event->description}}
                        </p>
                        <div class="m-t-20 row">
                            @foreach($event->photos as $photo)
                            <a href="{{ url('storage/'.$photo->path) }}" data-toggle="lightbox" data-effect="mfp-zoom-in" data-gallery="multiimages" data-title="{{$photo->caption}}"><img src="{{ url('storage/'.$photo->path) }}" alt="gallery" class="all studio col-md-3 col-xs-12" /></a>
                            @endforeach
                        </div>
                        @empty
                        No events recorded for this profile
                        @endforelse
                    </div>
                    <div class="tab-pane p-4" id="documents" role="tabpanel">
                        <div class="row">
                        <div class="p-2">
                            <strong>PERSONAL DOCUMENTS</strong> | 
                            <a href="#" data-toggle="modal" data-target="#upload-documents">
                                <svg class="c-icon">
                                    <use xlink:href="{{asset('new/node_modules/@coreui/icons/sprites/free.svg#cil-cloud-upload')}}"></use>
                                </svg>
                                Upload new
                            </a>
                        </div>
                        <table class="table table-responsive-sm table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Uploaded by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($profile->documents as $index=>$document)
                                <tr>
                                    <td style="width: 50%;">{{$document->description}}</td>
                                    <td style="width: 40%;">{{$document->user->name}}</td>
                                    <td style="width: 10%;">
                                        <a href="/profile/documents/{{$document->id}}/download">
                                            <svg class="c-icon">
                                                <use xlink:href="{{asset('new/node_modules/@coreui/icons/sprites/free.svg#cil-cloud-download')}}"></use>
                                            </svg>
                                        </a>
                                        <a href="/profile/documents/{{$document->id}}/delete">
                                            <svg class="c-icon">
                                                <use xlink:href="{{asset('new/node_modules/@coreui/icons/sprites/free.svg#cil-trash')}}"></use>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="p-2">
                                <strong>OTHER DOCUMENTS </strong>
                            </div>
                            <table class="table table-responsive-sm table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Document type</th>
                                        <th>Effective date</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($profile->documentation as $index=>$document)
                                    <tr>
                                        <td>{{$document->document_types->type}}</td>
                                        <td>{{$document->effective_date}}</td>
                                        <td>{{$document->file_location}}</td>
                                        <td>
                                            <a href="{{route('documentation.edit', $document->id)}}">
                                                <svg class="c-icon">
                                                    <use xlink:href="{{asset('new/node_modules/@coreui/icons/sprites/free.svg#cil-pencil')}}"></use>
                                                </svg>
                                            </a>
                                            @if($document->files)
                                                <a href="{{route('documentation-download', $document->id)}}">
                                                    <svg class="c-icon">
                                                        <use xlink:href="{{asset('new/node_modules/@coreui/icons/sprites/free.svg#cil-cloud-download')}}"></use>
                                                    </svg>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane p-4" id="about" role="tabpanel">
                        <div class="row about-section">
                            <br>
                            <div class="user-bg p-2">
                                @if($profile->photo)
                                <img alt="user" src="/fruit_profiles/thumbnail/{{$profile->photo}}" class="img-circle">
                                @else
                                <center>
                                    <img  alt="user" src="/fruit_profiles/photos/no-image.png" class="img-circle">
                                </center>
                                No photo selected
                                @endif
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                <a href="#" slug="{{$profile->slug}}" class="edit-btn" section="about"><span class="fa fa-pencil"></span> Edit</a></a>

                                </div>
                            </div>
                            </div>
                            <br>
                                <table class="table table-bordered table-sm table-responsive-sm">
                                    <tbody>
                                    <tr>
                                        <td><strong>Full name</strong></td>
                                        <td> @foreach($profile->title as $title) {{$title->title}} @endforeach {{$profile->fullname}} {{$profile->lastname}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gender</strong></td>
                                        <td> {{$profile->gender->gender}} </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date of Birth</strong></td>
                                        <td> {{$profile->dob}} </td>
                                    </tr>
                                    @if($profile->bio)
                                    <tr>
                                        <td><strong>Bio</strong></td>
                                        <td> {{$profile->bio}} </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td><strong>Country</strong></td>
                                        <td> {{$profile->country->name}} </td>
                                    </tr>
                                    <tr>
                                        <td><strong>City</strong></td>
                                        <td> {{$profile->city->name}} </td>
                                    </tr>
                                        <tr>
                                            <td><strong>Languages</strong></td>
                                            <td>   @foreach($profile->language as $language)
                                                    {{$language->name}}.
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Responsible Staff</strong></td>
                                            <td>{{$profile->maintainer->name}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        <div class="row other-information-secion">

                        <strong>OTHER INFORMATION</strong>
                            <table class="table table-bordered table-sm table-responsive-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>Platform (Media only)</strong></td>
                                        <td> {{$profile->platform}} </td>
                                    </tr>
                                    <tr>
                                        <td><strong>History</strong></td>
                                        <td> {{$profile->history}} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane p-4" id="contacts" role="tabpanel">

                        <div class="row contacts-section">
                            <div class="row">
                                <div class="col-md-9">
                                    <strong>PERSONAL CONTACT INFORMATION</strong>
                                </div>
                                <div class="col-md-3">
                                    <div class="pull-right">
                                    <a href="#" slug="{{$profile->slug}}" class="edit-btn" section="contact"><span class="fa fa-pencil"></span> Edit</a></a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-sm table-responsive-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>Mobile</strong></td>
                                        <td> {{$profile->mobile_no}} <br>
                                    {{$profile->mobile_no2}} <br> {{$profile->mobile_no_other}} </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td> {{$profile->email}} <br>
                                            {{$profile->email2}} </td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="pb-2">
                                <strong>ORGANISATIONS</strong>
                            </div>
                            
                            @forelse($organizations as $index=>$profile_organization)
                            <div class="table-responsive organisation-{{$profile_organization->id}}">
                                <div class="row">
                                    <div class="col-md-8">
                                    <mark><strong>{{$profile_organization->organization->name}}</strong></mark>

                                    </div>
                                    <div class="col-md-4">
                                    <div class="pull-right">
                                        <a href="#" slug="{{$profile->slug}}" class="edit-btn" id="{{$profile_organization->id}}" section="organisation">
                                            <svg class="c-icon">
                                                <use xlink:href="{{asset('new/node_modules/@coreui/icons/sprites/free.svg#cil-cloud-download')}}"></use>
                                            </svg>
                                        </a>
                                        <a href="#" slug="{{$profile->slug}}" class="delete-btn" id="{{$profile_organization->id}}" section="organisation">
                                            <svg class="c-icon">
                                                <use xlink:href="{{asset('new/node_modules/@coreui/icons/sprites/free.svg#cil-trash')}}"></use>
                                            </svg>
                                        </a>
                    
                                    </div>
                                    </div>
                                </div>
                                <br>
                                <table class="table" style="background-color: #fcfcfc; border: 1px solid #dbd9d9">
                                    <tbody>
                                        <tr>
                                            <td><strong>Position</strong></td>
                                            <td> {{$profile_organization->position}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Department</strong></td>
                                            <td> {{$profile_organization->department}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Website</strong></td>
                                            <td> <a href="http://{{$profile_organization->organization->website}}" target="_blank">{{$profile_organization->organization->website}}</a> </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Number</strong></td>
                                            <td> {{$profile_organization->work_number}} <br>
                                            {{$profile_organization->work_number2}} <br>
                                            {{$profile_organization->work_number_other}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td> {{$profile_organization->email}} <br>
                                            {{$profile_organization->email2}} <br>
                                            {{$profile_organization->email_other}} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @empty
                                Not affiliated to any organisation
                            @endforelse
                            <h5>
                                <div class="new-organisation-section"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a  href="#organisationsModal" data-toggle="modal" class="add-organisation-btn"><strong> <span class="fa fa-plus-circle"></span> Add organisation</strong></a>
                                    </div>
                                    @include('profiles.forms.create-organisation', ['organizations_list'=>$organizations_list])
                                </div>
                            </h5>
                            <hr>
                            <strong>ASSISTANTS</strong>
                            @forelse($assistants as $index=>$assistant)
                            <div class="table-responsive assistant-{{$assistant->id}}">
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                    <a href="#" slug="{{$profile->slug}}" class="edit-btn" id="{{$assistant->id}}" section="assistant"><span class="fa fa-pencil"></span> Edit</a> |
                                    <a href="#" slug="{{$profile->slug}}" class="delete-btn" id="{{$assistant->id}}" section="assistant"><span class="fa fa-trash"></span> Delete</a>
                                    </div>
                                </div>
                                </div>
                                <table class="table table-bordered table-sm table-responsive-sm" style="background-color: #fcfcfc; border: 1px solid #dbd9d9">
                                    <tbody>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td>{{$assistant->assistant_name}}</td>
                                    </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td>
                                            <strong>P</strong>: {{$assistant->assistant_email1}} <br>
                                            <strong>S</strong>: {{$assistant->assistant_email2}} <br>
                                            <strong>O</strong>: {{$assistant->assistant_email3}} <br></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Number</strong></td>
                                            <td>
                                            <strong>P</strong>: {{$assistant->assistant_number1}} <br>
                                            <strong>S</strong>: {{$assistant->assistant_number2}} <br>
                                            <strong>O</strong>: {{$assistant->assistant_number3}} <br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @empty
                            No assistants
                            @endforelse
                            <h5>
                                <div class="new-assistant-section"></div>
                                <div class="row">
                                <div class="col-md-12">
                                    <a  href="#assistantsModal" data-toggle="modal" class="add-assistant-btn"><strong> <span class="fa fa-plus-circle"></span> Add assistant</strong></a>
                                </div>
                                @include('profiles.forms.create-assistant')
                                </div>
                            </h5>
                        </div>
                    </div>
                    <div class="tab-pane p-4" id="relationship" role="tabpanel">
                        <div class="row relationship-section">
                            <div class="row">
                                <div class="col-md-12">
                                <div class="pull-right">
                                <a href="#" slug="{{$profile->slug}}" class="edit-btn" section="relationship"><span class="fa fa-pencil"></span> Edit</a></a>
                                </div>
                                </div>
                            </div>

                                <table class="table table-bordered table-sm table-responsive-sm">
                                    <tbody>
                                        <tr>
                                            <td><strong>Sector</strong></td>
                                            <td> {{$profile->sector->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Team</strong></td>
                                            <td> {{$profile->team->name}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Appointed Role</strong></td>
                                            <td> {{ $profile->fruit_role->role}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Level</strong></td>
                                            <td> {{ $profile->fruit_stage->stage}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Rank</strong></td>
                                            <td> {{$profile->fruit_level->level}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Cult Awareness</strong></td>
                                            <td> {{$profile->cult_awareness}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pre-Poisoned</strong></td>
                                            <td> {{$profile->pre_poisoned}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>WARP Attendee</strong></td>
                                            <td> {{$profile->warp_attendee}} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Religion</strong></td>
                                            <td> {{$profile->religion->name}} </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        <div class="row">
                            <strong>WARP SUMMIT ATTENDANCE</strong>
                            <hr>
                                <table class="table table-bordered table-sm table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Year attended</th>
                                            <th>Financing</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($profile->warp_summit as $index=>$summit)
                                        <tr>
                                            <td>{{date('Y', strtotime($summit->date_attended))}}</td>
                                            <td>{{$summit->financing}}</td>
                                            <td>
                                                <a href="{{route('warp-attendees.edit', $summit->id)}}" onclick="return confirm('Are you sure you want to delete this record?');">
                                                <svg class="c-icon">
                                                    <use xlink:href="{{asset('new/node_modules/@coreui/icons/sprites/free.svg#cil-pencil')}}"></use>
                                                </svg>
                                                </a>
                                                <a href="{{route('warp-attendees.delete', $summit->id)}}">
                                                    <svg class="c-icon">
                                                        <use xlink:href="{{asset('new/node_modules/@coreui/icons/sprites/free.svg#cil-trash')}}"></use>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('contactsJS')
<script src="{{asset('js/contacts.js')}}"></script>
@endpush
@endsection
