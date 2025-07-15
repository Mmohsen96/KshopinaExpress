@extends('layouts.staff_layout')

@section('content')


<style>
.filterable {
  margin-top: 15px;
}
.filterable .panel-heading .pull-right {
  margin-top: -20px;
}
.filterable .filters input[disabled] {
  background-color: transparent;
  border: none;
  cursor: auto;
  box-shadow: none;
  padding: 0;
  height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
  color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
  color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
  color: #333;
}


</style>

<br>
<h2>Testing Task List Filters</h2>
<hr><br>

<div class="container">
  <div class="row">

    <table class="table">
      <thead>
        <tr class="filters">
          <th>Assigned User
            <select id="assigned-user-filter" class="form-control">
              <option>None</option>
              <option>John</option>
              <option>Rob</option>
              <option>Larry</option>
              <option>Donald</option>
              <option>Roger</option>
            </select>
          </th>
          <th>Status
            <select id="status-filter" class="form-control">
              <option>Any</option>
              <option>Not Started</option>
              <option>In Progress</option>
              <option>Completed</option>
            </select>
          </th>
          <th>Milestone
            <select id="milestone-filter" class="form-control">
              <option>None</option>
              <option>Milestone 1</option>
              <option>Milestone 2</option>
              <option>Milestone 3</option>
            </select>
          </th>
          <th>Priority
            <select id="priority-filter" class="form-control">
              <option>Any</option>
              <option>Low</option>
              <option>Medium</option>
              <option>High</option>
              <option>Urgent</option>
            </select>
          </th>
          <th>Tags
            <select id="tags-filter" class="form-control">
              <option>None</option>
              <option>Tag 1</option>
              <option>Tag 2</option>
              <option>Tag 3</option>
            </select>
          </th>
        </tr>
      </thead>
    </table>

    <div class="panel panel-primary filterable">
      <div class="panel-heading">
        <h3 class="panel-title">Tasks</h3>
        <div class="pull-right"></div>
      </div>

      <table id="task-list-tbl" class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Created</th>
            <th>Due Date</th>
            <th>Priority</th>
            <th>Milestone</th>
            <th>Assigned User</th>
            <th>Tags</th>
          </tr>
        </thead>

        <tbody>

          <tr id="task-1" class="task-list-row" data-task-id="1" data-user="Larry" data-status="In Progress" data-milestone="Milestone 2" data-priority="Urgent" data-tags="Tag 2">
            <td>Task title 1</td>
            <td>01/24/2015</td>
            <td>09/24/2015</td>
            <td>Urgent</td>
            <td>Milestone 2</td>
            <td>Larry</td>
            <td>Tag 2</td>
          </tr>

          <tr id="task-2" class="task-list-row" data-task-id="2" data-user="Larry" data-status="Not Started" data-milestone="Milestone 2" data-priority="Low" data-tags="Tag 1">
            <td>Task title 2</td>
            <td>03/14/2015</td>
            <td>09/18/2015</td>
            <td>Low</td>
            <td>Milestone 2</td>
            <td>Larry</td>
            <td>Tag 1</td>
          </tr>

          <tr id="task-3" class="task-list-row" data-task-id="3" data-user="Donald" data-status="Not Started" data-milestone="Milestone 1" data-priority="Low" data-tags="Tag 3">
            <td>Task title 3</td>
            <td>11/16/2014</td>
            <td>02/29/2015</td>
            <td>Low</td>
            <td>Milestone 1</td>
            <td>Donald</td>
            <td>Tag 3</td>
          </tr>

          <tr id="task-4" class="task-list-row" data-task-id="4" data-user="Donald" data-status="Completed" data-milestone="Milestone 1" data-priority="High" data-tags="Tag 1">
            <td>Task title 4</td>
            <td>11/16/2014</td>
            <td>02/29/2015</td>
            <td>High</td>
            <td>Milestone 1</td>
            <td>Donald</td>
            <td>Tag 1</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="row" style="justify-content: center;margin: 0px;">

  <div class="col-md-2">
      <div class="row stati turquoise  "
          style="box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%); display: flex;flex-direction: column;">
          <div>

              <p class="card_title">
                  Longest time to replay on complaint </p>
              <hr style="margin-top: 0px;margin-bottom: 0px;">
          </div>
          <div class="card_contents">
              {{-- <i class="fas fa-user-clock" style="margin-right: 1rem;"></i> --}}
              <div style="display: flex; align-items: center;">
                  <h3 style="padding: 4px;color: #cb9d48;"> {{-- {{ $average_fvm_in_days }} --}}</h3> <span
                      style="font-family: 'Bebas Neue', cursive !important;font-size: 14px;letter-spacing: 1px;">days</span>
                  <h5 style="padding: 4px;color: #cb9d48;"> {{-- {{ $average_fvm_in_hours }} --}}</h5> <span
                      style="font-family: 'Bebas Neue', cursive !important;font-size: 14px;letter-spacing: 1px;">hours</span>
              </div>
          </div>
      </div>
  </div>

  <div class="col-md-2">
      <div class="row stati turquoise  "
          style="box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%); display: flex;flex-direction: column;">
          <div>
              <p class="card_title">Shortest time to replay on complain</p>
              <hr style="margin-top: 0px;margin-bottom: 0px;">
          </div>
          <div class="card_contents">
              {{-- <i class="fas fa-clock" style="margin-right: 1rem;"></i> --}}
              <div style="display: flex; align-items: center;">
                  <h3 style="padding: 8px;color: #cb9d48;"> {{-- {{ $average_first_customer_interaction_in_days }} --}}</h3> <span
                      style="font-family: 'Bebas Neue', cursive !important;font-size: 14px;letter-spacing: 1px;">days</span>
                  <h5 style="padding: 8px;color: #cb9d48;"> {{-- {{ $average_first_customer_interaction_in_hours }} --}}</h5> <span
                      style="font-family: 'Bebas Neue', cursive !important;font-size: 14px;letter-spacing: 1px;">hours</span>
              </div>
          </div>
      </div>
  </div>

  <div class="col-md-2">
      <div class="row stati turquoise  "
          style="box-shadow: 0px 0.2em 0.4em rgb(0 0 0 / 15%); display: flex;flex-direction: column;">
          <div>
              <p class="card_title">Average time to answer on complaint</p>
              <hr style="margin-top: 0px;margin-bottom: 0px;">
          </div>
          <div class="card_contents">
              {{-- <i class="fas fa-clock" style="margin-right: 1rem;"></i> --}}
              <div style="display: flex; align-items: center;">
                  <h3 style="padding: 8px;color: #cb9d48;"> {{-- {{$average_cust_CS_replay_in_days}} --}}
                  </h3> <span
                      style="font-family: 'Bebas Neue', cursive !important;font-size: 14px;letter-spacing: 1px;">days</span>
                  <h5 style="padding: 8px;color: #cb9d48;"> {{-- {{$average_cust_CS_replay_in_hours}} --}}</h5> <span
                      style="font-family: 'Bebas Neue', cursive !important;font-size: 14px;letter-spacing: 1px;">hours</span>
              </div>
          </div>
      </div>
  </div>


</div>

<script>
   var filters = {
  user: null,
  status: null,
  milestone: null,
  priority: null,
  tags: null
};

function updateFilters() {
  $(".task-list-row")
    .hide()
    .filter(function () {
      var self = $(this),
        result = true; // not guilty until proven guilty

      Object.keys(filters).forEach(function (filter) {
        if (
          filters[filter] &&
          filters[filter] != "None" &&
          filters[filter] != "Any"
        ) {
          result = result && filters[filter] === self.data(filter);
        }
      });

      return result;
    })
    .show();
}

function changeFilter(filterName) {
  filters[filterName] = this.value;
  updateFilters();
}

// Assigned User Dropdown Filter
$("#assigned-user-filter").on("change", function () {
  changeFilter.call(this, "user");
});

// Task Status Dropdown Filter
$("#status-filter").on("change", function () {
  changeFilter.call(this, "status");
});

// Task Milestone Dropdown Filter
$("#milestone-filter").on("change", function () {
  changeFilter.call(this, "milestone");
});

// Task Priority Dropdown Filter
$("#priority-filter").on("change", function () {
  changeFilter.call(this, "priority");
});

// Task Tags Dropdown Filter
$("#tags-filter").on("change", function () {
  changeFilter.call(this, "tags");
});

/*
future use for a text input filter
$('#search').on('click', function() {
    $('.box').hide().filter(function() {
        return $(this).data('order-number') == $('#search-criteria').val().trim();
    }).show();
});*/

</script>

@endsection