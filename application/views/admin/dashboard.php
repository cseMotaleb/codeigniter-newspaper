<?php
    $currency = $this->config->item("currency");
    $currency_symbol = $this->config->item("currency_symbol");
?>
<style>
	.bs-glyphicons {
		padding-left: 0;
		padding-bottom: 1px;
		margin-bottom: 20px;
		list-style: none;
		overflow: hidden;
	}
	.bs-glyphicons li {
		float: left;
		width: 25%;
		height: 115px;
		padding: 10px;
		margin: 0 -1px -1px 0;
		font-size: 12px;
		line-height: 1.4;
		text-align: center;
		border: 1px solid #ddd;
	}
	.bs-glyphicons .glyphicon {
		margin-top: 5px;
		margin-bottom: 10px;
		font-size: 24px;
	}
	.bs-glyphicons .glyphicon-class {
		display: block;
		text-align: center;
	}
	.bs-glyphicons li:hover {
		background-color: rgba(86,61,124,.1);
	}

	@media (min-width: 768px) {
		.bs-glyphicons li {
			width: 12.5%;
		}
	}
	#sparks {
		text-align: center;
	}
</style>
<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Dashboard
		</h1>
	</div>
</div>
<?php /*
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-2">
                <div class="well well-sm bg-color-darken text-center">
                    <h5><a class="txt-color-white" href="#products/manage">Add Product</a></h5>
                </div>
            </div>
            <div class="col-md-2">
                <div class="well well-sm bg-color-teal text-center">
                    <h5><a class="txt-color-white" href="#orders/">Sales Products</a></h5>
                </div>
            </div>
            <div class="col-md-2">
                <div class="well well-sm bg-color-pinkDark text-center">
                    <h5><a class="txt-color-white" href="#products/">Product List</a></h5>
                </div>
            </div>
            <div class="col-md-2">
                <div class="well well-sm bg-color-darken text-center">
                    <h5><a class="txt-color-white" href="#suppliers/manage">Add Supplier</a></h5>
                </div>
            </div>
            <div class="col-md-2">
                <div class="well well-sm bg-color-teal text-center">
                    <h5><a class="txt-color-white" href="#customers/manage">Add Customer</a></h5>
                </div>
            </div>
            <div class="col-md-2">
                <div class="well well-sm bg-color-pinkDark text-center">
                    <h5><a class="txt-color-white" href="#pages/manage">Add Pages</a></h5>
                </div>
            </div>
        </div>
    </div>
</div>
*/ ?>

<script type="text/javascript">
    pageSetUp();
</script>   