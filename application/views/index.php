<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SWAPI</title>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
</head>

<body>
  <div>
    <p id="searchInstruction" style="font-style: italic; color: gray; text-align:right;">Press Enter to search</p>
    <table class="table" id="tblPerson">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Gender</th>
          <th scope="col">Homeworld</th>
          <th scope="col">Starship</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="modal" id="planetModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Planet Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group">
              <span class="input-group">Name</span>
            </div>
            <input type="text" class="form-control" id="inputPlanetName" readonly>
          </div>
          <div class="input-group mb-3">
            <div class="input-group">
              <span class="input-group">Population</span>
            </div>
            <input type="text" class="form-control" id="inputPlanetPopulation" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $("#tblPerson").DataTable({
        ajax: {
          "url": '/person/ajax_get',
          "data": function (data) {
            data.data = data.results
          }
        },
        columns: [
          { data: "no" },
          { data: "name" },
          { data: "gender" },
          { data: "homeworld" },
          { data: "starship", defaultContent: "-" },
        ],
        bLengthChange : false,
        serverSide: true,
        processing: true,
        responsive: true,
        autoWidth: true,
        search: {
          return: true
        }
      });

      $('#planetModal').on('shown.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const planetId = button.data('id');
        const modal = $(this);

        // get planet data
        $.ajax({
            url: "/planet/get_by_id",
            data: {"id": planetId},
            dataType: "json",
            type: 'GET',
            success: function(data) {
                modal.find('#inputPlanetName').val(data.name);
                modal.find('#inputPlanetPopulation').val(data.population);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
      });
    });
  </script>
</body>

</html>