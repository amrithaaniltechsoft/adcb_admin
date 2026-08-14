@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ADCB Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $courseCount }}</h3>
                    <p>Courses</p>
                </div>
                <div class="icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <a href="{{ route('courses.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $mbbsCount }}</h3>
                    <p>MBBS States</p>
                </div>
                <div class="icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <a href="{{ route('mbbs.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $mdmsCount }}</h3>
                    <p>MD/MS States</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <a href="{{ route('mdms.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $mdsCount }}</h3>
                    <p>MDS Specialties</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tooth"></i>
                </div>
                <a href="{{ route('mds.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{ $dnbCount }}</h3>
                    <p>DNB Content</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-medical"></i>
                </div>
                <a href="{{ route('dnb.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $faqCount }}</h3>
                    <p>FAQs</p>
                </div>
                <div class="icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <a href="{{ route('faqs.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-indigo">
                <div class="inner">
                    <h3>{{ $opportunityCount }}</h3>
                    <p>International Opportunities</p>
                </div>
                <div class="icon">
                    <i class="fas fa-globe"></i>
                </div>
                <a href="{{ route('opportunities.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>{{ $contactCount }}</h3>
                    <p>Enquiries</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <a href="{{ route('contacts.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@stop
