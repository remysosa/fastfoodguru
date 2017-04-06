@extends('layouts.master')

@section('title')
    Welcome to FastFoodGuru!
@endsection

@section('content')
    <div class="container">
        <h1>Search</h1>

        {{-- Form returns original page --}}
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Find a fast food restaurant</h3>
          </div>
          <div class="panel-body">
              <form method='GET' action='/'>
                  <div class="form-group">
                      <label for='searchTerm'>Chain:</label>
                      <select class="form-control" name=searchTerm id=searchTerm>
                          @if($searchTerm)
                              <option value={{ $searchTerm }}>Select a different restaurant</option>
                          @else
                              <option value="">Select a restaurant</option>
                          @endif
                          <option>McDonald's</option>
                          <option value="burger+king">Burger King</option>
                          <option>KFC</option>
                          <option value="Boloco">Boloco</option>
                          <option>Subway</option>
                          <option value="dunkin+donuts">Dunkin Donuts</option>
                          <input type="checkbox" name="openNow" value="openNow"
                            {{ $openNow ? 'checked' : ''}}>Open Now
                      </select>
                  </div>
                  <input type='submit' class='btn btn-primary btn-small'>
              </form>
          </div>
        </div>
    </div>

    {{-- Testing location method --}}
    {{-- @if($position)
        {{ dump($position->latitude) }}
        {{ dump($position->longitude) }}
    @endif --}}

    @if($searchTerm)
        {{-- {{ dump($searchTerm) }}
        {{ $searchResultsURL }}
        {{ dump($searchResultsArray) }} --}}
    <div class="container">
        <ul class="list-group">
            @foreach ($searchResultsArray["results"] as $restaurant)
                <li class="list-group-item">
                    @if($restaurant["opening_hours"]["open_now"] == true)
                        <span class="label label-success">Open Now</span>
                    @else
                        <span class="label label-danger">Closed Now</span>
                    @endif
                    <h4>{{ $restaurant["formatted_address"] }}</h4>
                    <p>{{ $restaurant["name"] }}</p>
                    <a href="#info{{ $restaurant["id"] }}" class="btn btn-info" data-toggle="collapse">Show reviews</a>
                    <div id="info{{ $restaurant["id"] }}" class="collapse">
                        No reviews yet! <a href="/restaurant/{{ $restaurant["id"] }}"">Add a review?</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    @endif

@endsection
