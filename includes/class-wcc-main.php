<?php
/**
 * Calling W.ORG API Response.
 *
 * @package WP Themes & Plugins Stats
 * @author Brainstorm Force
 */

/**
 * Helper class for the ActiveCampaign API.
 *
 * @since 1.0.0
 */
class WCC_Main {
	/**
	 * The unique instance of the plugin.
	 *
	 * @var Instance variable
	 */
	private static $instance;
	/**
	 * Gets an instance of our plugin.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	/**
	 * Constructor calling W.ORG API Response.
	 */
	public function __construct() {
		add_shortcode( 'wcc_chart', array( $this, 'wcc_display_chart' ) );	
	}
	/**
	 * Get the plugin Details.
	 *
	 * @param int $action Get attributes plugin Details.
	 * @param int $api_params Get attributes plugin Details.
	 * @return array $plugin Get plugin Details.
	 */
	public function wcc_display_chart() {

		?>
			<html>
			<body>
			    <canvas id="myCanvas">My Chart</canvas>
			    <div id="myLegend"></div>
			    <script type="text/javascript">
			    	var myCanvas = document.getElementById("myCanvas");
			    	myCanvas.width = 300;
			    	myCanvas.height = 300;
			    	 
			    	var ctx = myCanvas.getContext("2d");
			    	function drawLine(ctx, startX, startY, endX, endY){
			    	    ctx.beginPath();
			    	    ctx.moveTo(startX,startY);
			    	    ctx.lineTo(endX,endY);
			    	    ctx.stroke();
			    	}
			    	function drawArc(ctx, centerX, centerY, radius, startAngle, endAngle){
			    	    ctx.beginPath();
			    	    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
			    	    ctx.stroke();
			    	}
			    	function drawPieSlice(ctx,centerX, centerY, radius, startAngle, endAngle, color ){
			    	    ctx.fillStyle = color;
			    	    ctx.beginPath();
			    	    ctx.moveTo(centerX,centerY);
			    	    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
			    	    ctx.closePath();
			    	    ctx.fill();
			    	}
			    	drawLine(ctx,100,100,200,200);
			    	drawArc(ctx, 150,150,150, 0, Math.PI/3);
			    	drawPieSlice(ctx, 150,150,150, Math.PI/2, Math.PI/2 + Math.PI/4, '#ff0000');
			    	var myVinyls = {
			    	    "Classical music": 10,
			    	    "Alternative rock": 14,
			    	    "Pop": 2,
			    	    "Jazz": 12
			    	};
			    	var Piechart = function(options){
			    	    this.options = options;
			    	    this.canvas = options.canvas;
			    	    this.ctx = this.canvas.getContext("2d");
			    	    this.colors = options.colors;
			    	 
			    	    this.draw = function(){
			    	        var total_value = 0;
			    	        var color_index = 0;
			    	        for (var categ in this.options.data){
			    	            var val = this.options.data[categ];
			    	            total_value += val;
			    	        }
			    	 
			    	        var start_angle = 0;
			    	        for (categ in this.options.data){
			    	            val = this.options.data[categ];
			    	            var slice_angle = 2 * Math.PI * val / total_value;
			    	 
			    	            drawPieSlice(
			    	                this.ctx,
			    	                this.canvas.width/2,
			    	                this.canvas.height/2,
			    	                Math.min(this.canvas.width/2,this.canvas.height/2),
			    	                start_angle,
			    	                start_angle+slice_angle,
			    	                this.colors[color_index%this.colors.length]
			    	            );
			    	 
			    	            start_angle += slice_angle;
			    	            color_index++;
			    	        }
			    	 
			    	    }
			    	}
			    	var myPiechart = new Piechart(
			    	    {
			    	        canvas:myCanvas,
			    	        data:myVinyls,
			    	        colors:["#fde23e","#f16e23", "#57d9ff","#937e88"]
			    	    }
			    	);
			    	myPiechart.draw();
			    	  if (this.options.mylegend){
            			color_index = 0;
			            var legendHTML = "";
			            for (categ in this.options.data){
			                legendHTML += "<div><span style='display:inline-block;width:20px;background-color:"+this.colors[color_index++]+";'>&nbsp;</span> "+categ+"</div>";
			            }
			            this.options.legend.innerHTML = legendHTML;
			        }
			    	var Piechart = function(options){
			    	    this.options = options;
			    	    this.canvas = options.canvas;
			    	    this.ctx = this.canvas.getContext("2d");
			    	    this.colors = options.colors;
			    	 
			    	    this.draw = function(){
			    	        var total_value = 0;
			    	        var color_index = 0;
			    	        for (var categ in this.options.data){
			    	            var val = this.options.data[categ];
			    	            total_value += val;
			    	        }
			    	 
			    	        var start_angle = 0;
			    	        for (categ in this.options.data){
			    	            val = this.options.data[categ];
			    	            var slice_angle = 2 * Math.PI * val / total_value;
			    	 
			    	            drawPieSlice(
			    	                this.ctx,
			    	                this.canvas.width/2,
			    	                this.canvas.height/2,
			    	                Math.min(this.canvas.width/2,this.canvas.height/2),
			    	                start_angle,
			    	                start_angle+slice_angle,
			    	                this.colors[color_index%this.colors.length]
			    	            );
			    	 
			    	            start_angle += slice_angle;
			    	            color_index++;
			    	        }
			    	 
			    	        //drawing a white circle over the chart
			    	        //to create the doughnut chart
			    	        if (this.options.doughnutHoleSize){
			    	            drawPieSlice(
			    	                this.ctx,
			    	                this.canvas.width/2,
			    	                this.canvas.height/2,
			    	                this.options.doughnutHoleSize * Math.min(this.canvas.width/2,this.canvas.height/2),
			    	                0,
			    	                2 * Math.PI,
			    	                "#ff0000"
			    	            );
			    	        }
			    	 
			    	    }
			    	}
			    	var myDougnutChart = new Piechart(
			    	    {
			    	        canvas:myCanvas,
			    	        data:myVinyls,
			    	        colors:["#fde23e","#f16e23", "#57d9ff","#937e88"],
			    	        doughnutHoleSize:0.5
			    	    }
			    	);
			    	myDougnutChart.draw();
			    	start_angle = 0;
			    	for (categ in this.options.data){
			    	    val = this.options.data[categ];
			    	    slice_angle = 2 * Math.PI * val / total_value;
			    	    var pieRadius = Math.min(this.canvas.width/2,this.canvas.height/2);
			    	    var labelX = this.canvas.width/2 + (pieRadius / 2) * Math.cos(start_angle + slice_angle/2);
			    	    var labelY = this.canvas.height/2 + (pieRadius / 2) * Math.sin(start_angle + slice_angle/2);
			    	 
			    	    if (this.options.doughnutHoleSize){
			    	        var offset = (pieRadius * this.options.doughnutHoleSize ) / 2;
			    	        labelX = this.canvas.width/2 + (offset + pieRadius / 2) * Math.cos(start_angle + slice_angle/2);
			    	        labelY = this.canvas.height/2 + (offset + pieRadius / 2) * Math.sin(start_angle + slice_angle/2);               
			    	    }
			    	 
			    	    var labelText = Math.round(100 * val / total_value);
			    	    this.ctx.fillStyle = "white";
			    	    this.ctx.font = "bold 20px Arial";
			    	    this.ctx.fillText(labelText+"%", labelX,labelY);
			    	    start_angle += slice_angle;
			    	}
			    </script>
			</body>
			</html>
		<?php
	}

}
new WCC_Main();
$wcc_main = WCC_Main::get_instance();
