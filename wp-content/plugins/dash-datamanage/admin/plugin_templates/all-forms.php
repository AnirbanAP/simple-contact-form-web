<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <section class="all-forms position relative">
    <div class="container-fluid">
        <div class="wrap d-flex m-3">
            <h1 class="p-1">Contact Forms</h1> 
            <a href="http://localhost/wordpress-site/wp-admin/admin.php?page=add_new_form" class="btn btn-primary">Add new</a>
        </div>
        
        <div class="contact-forms">
            <table  id="form-listing-table" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Form Name</th>
                  <th>Shortcode</th>
                  <th>Author</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Contact Form</td>
                  <td>[----]</td>
                  <td>Anirban</td>
                  <td>14-11-24</td>
                  <td><a href="#" class="btn btn-primary">Edit</a> <a href="#" class="btn btn-danger">Delete</a></td>
                </tr>
              </tbody>
            </table>
            </table>
        </div>
    </div>
  </section>

  


  <script>
      var formlist = jQuery('#form-listing-table').dataTable({
            dom: '<"container-fluid"<"row align-items-center"<"custom-col pool_details_table_pagelength"l><"custom-col pool_details_table_buttons"B><"custom-col pool_details_table_search table_search"f>>>rtip',
            select: true,
            // buttons: [
            //     {
            //         text: 'Choose Winner',
            //         className: "btn solid-color btn-primary winnerSelect",
            //     },
            // ],
            fixedColumns: false,
            responsive: false,
            paging: true,
            pageLength: 6,
            lengthMenu: [[2, 4, 6, 10, 50, -1], [2, 4, 6, 10, 50, "All"]],
            oLanguage: { "sSearch": "Search Here: " },
            language : {
                sLengthMenu: "Show _MENU_"
            }
        });
  </script>