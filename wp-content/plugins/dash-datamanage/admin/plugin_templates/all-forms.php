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
                  <th></th>
                  <th>ID</th>
                  <th>Form Name</th>
                  <th>Shortcode</th>
                  <th>Author</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $args = array(
                       'post_type' => 'contact_simple_form',
                       'post_status' => 'publish',
                       'order'      => 'ASC'
                    );
                    $the_query = new WP_Query( $args );
                    $index = 0;
                    if ( $the_query->have_posts() ) {
                       while ( $the_query->have_posts() ) {
                        $index++;
                           $the_query->the_post();
                           $author_id = get_the_author_meta( 'ID' );
                           $author_name = get_the_author_meta( 'display_name', $author_id );
                           $date = get_the_date('d-m-Y');
                           $form_name = get_the_title(get_the_ID());
                           $shortcode = get_post_meta(get_the_ID(),'c_s_form_shortcode',true);

                ?>
                <tr data-formpostid="<?php echo get_the_ID(); ?>">
                  <th scope="row"><input type="checkbox"></th>
                  <td><?php echo $index;?></td>
                  <td><?php echo $form_name; ?></td>
                  <td><?php echo $shortcode; ?></td>
                  <td><?php echo $author_name; ?></td>
                  <td><?php echo $date; ?></td>
                  <td><a href="<?php echo admin_url(); ?>admin.php?page=edit_form&edit_id=<?php echo get_the_ID(); ?>" class="btn btn-primary">Edit</a> <a href="javascript:void(0);" class="btn btn-danger c_s_deleteform" data-postid="<?php echo get_the_ID(); ?>">Delete</a></td>
                </tr>
                <?php } }?>
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
           
            fixedColumns: {
              start: 2
            },
            order: [[1, 'asc']],
            responsive: false,
            paging: true,
            pageLength: 6,
            lengthMenu: [[2, 4, 6, 10, 50, -1], [2, 4, 6, 10, 50, "All"]],
            oLanguage: { "sSearch": "Search Here: " },
            language : {
                sLengthMenu: "Show _MENU_"
            },
            select: {
                style: 'os',
                selector: 'td:first-child'
            }
        });
  </script>