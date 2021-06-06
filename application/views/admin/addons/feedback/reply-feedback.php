<div class="row">
    <div class="col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-pencil-square-o"></i> Send Mail
        </h1>
    </div>
    <div class="col-lg-6">
        <div class="btn-group btn-sm pull-right">
            <button class="btn btn-success changeURL" data-url="#feedback/"><i class="fa fa-navicon"></i> Feedback List</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Send Mail (Subscriber)
            </div>
            <div class="panel-body">
                <form id="validate-feedback" action="<?= site_url("admin/feedback/reply/{$current_id}"); ?>" method="post">
                    <div class="formSep">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="req">Sender Email</label>
                                <input class="form-control" type="text" id="sender_email" name="sender_email" placeholder="Sender email" value="<?= $this->config->item('company_email'); ?>" />
                            </div>
                            <div class="col-md-6">
                                <label class="req">Reply To</label>
                                <input class="form-control" type="text" id="email" name="email" placeholder="Email" value="<?= $row_data['email']; ?>" />
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="formSep">
                        <div class="row">
                            <div class="col-md-6">
                                <label>CC</label>
                                <input class="form-control" type="text" id="cc" name="cc" placeholder="CC" value="" />
                            </div>
                            <div class="col-md-6">
                                <label>BCC</label>
                                <input class="form-control" type="text" id="bcc" name="bcc" placeholder="BCC" value="" />
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="formSep">
                        <label class="req">Subject</label>
                        <input class="form-control" type="text" id="subject" name="subject" placeholder="Enter subject" value="Re: " />
                    </div>

                    <hr />

                    <div class="panel panel-default">
                        <div class="panel-heading">Message</div>
                        <div class="panel-body">
                            <textarea class="ckeditor" id="message" name="message">Dear <?= $row_data['name']; ?>,<br /><br /><br />Thanking you,<br /><br />---------------------------------------<br />
                            <?= $row_data['message']; ?><br />
                            Message ID # <?= $row_data['id']; ?><br />Dated: <?= $row_data['date_timestamp']; ?></textarea>
                        </div>
                    </div>

                    <footer>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
    pageSetUp();

    var pagefunction = function() {
    CKEDITOR.instances['message'].on('change', function() { CKEDITOR.instances['message'].updateElement() });
        var $checkoutForm = $('#validate-feedback').validate({
            rules : {
                sender_email : {
                    required : true,
                    email    : true
                },
                email : {
                    required : true,
                    email    : true
                },
                subject : {
                    required : true
                }
            },
            messages : {
                sender_email : {
                    required : 'Please enter your email'
                },
                email : {
                    required : 'Please enter email'
                },
                subject : {
                    required : 'Please enter subject'
                }
            },
            submitHandler : function(form) {
                $(form).ajaxSubmit({
                    success : processJson
                });
            },
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });

        function processJson(data) {
            var obj = jQuery.parseJSON( data );
            $.bigBox({
              title: obj.mtitle,
              content: obj.mcontent,
              color: obj.mcolor,
              iconSmall: obj.miconSmall,
              timeout: 10000
            });

            if(obj.mcode == 200) {
                $("#validate-feedback").attr("action", "<?= site_url("admin/feedback/reply"); ?>/" + obj.return_id);
                $('#zone_id').val(obj.data_listing_id);
                window.history.pushState("string", "Reply Mail", "#feedback/reply/" + obj.return_id);
            }
        };
    };

    loadScript("<?= site_url('assets/admin/js/plugin/jquery-form/jquery-form.min.js'); ?>", pagefunction);
</script>