<!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/rich-text-editor-vj@3.0.6/css/froala_editor.min.css">

<!-- Include Bootstrap JS and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/rich-text-editor-vj@3.0.6/js/froala_editor.min.js"></script>

<section class="add-forms position-relative">
    <div class="container-fluid py-4">
        <div class="wrap">
            <h1 class="wp-heading-inline mb-3">Add New Form</h1>
            <hr class="wp-header-end mb-4">

            <form action="" method="post" id="add-form">
                <div class="row">
                    <!-- Main Content Area -->
                    <div class="col-md-8">
                        <div class="form-title-sec mb-4">
                            <input type="hidden" name="action" value="add_new_form">
                            <div class="form-group">
                                <input type="text" id="form-name" name="form-name" class="form-control" placeholder="Enter title here" required>
                            </div>
                        </div>

                        <!-- Bootstrap Tabs Navigation -->
                        <ul class="nav nav-tabs" id="formTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="form-tab" data-bs-toggle="tab" href="#form" role="tab">Form</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="mail-tab" data-bs-toggle="tab" href="#mail" role="tab">Mail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="messages-tab" data-bs-toggle="tab" href="#messages" role="tab">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="additional-settings-tab" data-bs-toggle="tab" href="#additional-settings" role="tab">Additional Settings</a>
                            </li>
                        </ul>

                        <!-- Bootstrap Tab Content -->
                        <div class="tab-content mt-3" id="formTabContent">
                            <!-- Form Tab Content -->
                            <div class="tab-pane fade show active" id="form" role="tabpanel">
                                <h3>Form</h3>
                                <small>You can edit the form template here. </small>
                                <div class="form-group mt-3 mb-3">
                                    <label for="form-element-type">Choose Form Element</label>
                                    <!-- Choose Form Type Radio Buttons -->
                                    <div class="choose-form-type mt-2 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">Element Select</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Custom HTML</label>
                                        </div>
                                    </div>

                                    <!-- Form Element Selector -->
                                    <div class="select-elements mb-3 active">
                                        <select id="form-element-type" class="form-control form-elements">
                                            <option value="text">Text Input</option>
                                            <option value="email">Email</option>
                                            <option value="number">Number</option>
                                            <option value="textarea">Textarea</option>
                                            <option value="date">Date</option>
                                            <option value="tel">Tel</option>
                                            <option value="checkbox">Checkbox</option>
                                            <option value="file">File</option>
                                            <option value="radio">Radio Button</option>
                                            <option value="select">Dropdown</option>
                                        </select>
                                        <button type="button" id="add-element-btn" class="btn btn-success mt-2">Add Element</button>
                                    </div>

                                    <!-- Custom HTML Editor -->
                                    <div class="custom-html-container mb-3" id="custom_html" style="display:none">
                                        <div id="froala-editor">
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Form Elements Container -->
                                <div class="postbox-container" id="form-elements-container"></div>
                            </div>

                            <!-- Mail Tab Content -->
                            <div class="tab-pane fade" id="mail" role="tabpanel">
                                <div class="form-group">
                                    <label for="mail-settings">Mail Settings</label>
                                    <textarea id="mail-settings" name="mail-settings" class="form-control" rows="6" placeholder="Define your mail settings here"></textarea>
                                </div>
                            </div>

                            <!-- Messages Tab Content -->
                            <div class="tab-pane fade" id="messages" role="tabpanel">
                                <div class="form-group">
                                    <label for="message-settings">Messages</label>
                                    <textarea id="message-settings" name="message-settings" class="form-control" rows="6" placeholder="Define your message settings here"></textarea>
                                </div>
                            </div>

                            <!-- Additional Settings Tab Content -->
                            <div class="tab-pane fade" id="additional-settings" role="tabpanel">
                                <div class="form-group">
                                    <label for="additional-settings-field">Additional Settings</label>
                                    <textarea id="additional-settings-field" name="additional-settings-field" class="form-control" rows="6" placeholder="Additional settings"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar for Save Button -->
                    <div class="col-md-4">
                        <div id="submitdiv" class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Status</h5>
                            </div>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save"></i> Save Form
                                </button>
                            </div>
                        </div>
                    </div>
                </div> <!-- .row -->
            </form>
        </div>
    </div>
</section>


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Add field data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" method="post" id="form_data">
                <div class="form-group">
                    <label for="element-type">Form Element
                        <select id="element_type" class="form-control">
                        </select>
                        <input type="checkbox" data-tag-part="type-suffix" id="field_required" value="*">
		                This is a required field.	
                    </label>
                </div>
                <div class="form-group">
                    <label for="element-label">Element Label</label>
                    <input type="text" class="form-control" id="element_label" name="element-label">
                </div>
                <div class="form-group placeholder-ele">
                    <label for="element-placeholder">Element Placeholder</label>
                    <input type="text" class="form-control" id="placeholder" name="element-Placeholder">
                </div>
                <div class="form-group select-dropdown" style="display:none">
                    <label for="element-description">Add Option</label>
                    <textarea class="form-control" id="dropdown_field" name="element-dropdown" rows="3"></textarea>
                    <small class="text-muted">Use enter to separate options.</small>
                </div>

                <div class="form-group checkbox-data" style="display:none">
                    <label for="element-checkbox">Add Option</label>
                    <textarea class="form-control" id="checkbox_field" name="element-checkbox" rows="3"></textarea>
                    <small class="text-muted">Use enter to separate options.</small>
                </div>

                <div class="form-group file-data" style="display:none">
                    <label for="element-fiels">Add Files Type</label>
                    <input type="text" pattern="[0-9a-z*\/\|]*" value="audio/*|video/*|image/*" aria-labelledby="tag-generator-panel-file-filetypes-option-legend" aria-describedby="tag-generator-panel-file-filetypes-option-description" data-tag-part="option" data-tag-option="filetypes:">
                    <small class="text-muted">Pipe-separated file types list. You can use file extensions and MIME types.</small>

                    <br>

                    <label for="element-description">Add File Size</label>
                    <input type="text" pattern="[0-9]*" value="10000" aria-labelledby="tag-generator-panel-file-filesize-option-legend" aria-describedby="tag-generator-panel-file-filesize-option-description" data-tag-part="option" data-tag-option="filesize:">
                    <small class="text-muted">In bytes. You can use kb and mb suffixes.</small>
                </div>

                <input type="hidden" id="form_id" name="form_id" value="<?php echo $form_id;?>">

                <button type="submit" class="btn btn-primary w-100 save_form_elenets mt-2">  <i class="fas fa-save"></i>Insert Data</button>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Initialize Froala Editor -->
<script>
  new FroalaEditor('#froala-editor');


  jQuery(document).ready(function() {
    // Add Element Button Click Event
    jQuery('#inlineRadio1').attr('checked', 'checked');

    jQuery('#inlineRadio2').click(function(){
        jQuery('#custom_html').show();
        jQuery('#form-element-type').hide();
        jQuery('#add-element-btn').hide();
        jQuery('#inlineRadio1').attr('checked', '');
    });
    jQuery('#inlineRadio1').click(function(){
        jQuery('#custom_html').hide();
        jQuery('#form-element-type').show();
        jQuery('#add-element-btn').show();
    });

  });
</script>
