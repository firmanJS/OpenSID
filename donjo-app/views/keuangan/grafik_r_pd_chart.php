<div id="<?= $type . '-' . $smt . '-' . $thn ?>" ></div>

<script type="text/javascript">
	$(document).ready(function (){
		var pointWidth = 25,
			anggaran = [<?= join($anggaran, ',') ?>],
			countData = anggaran.length,
			marginTop = 70,
		    marginRight = 10,
		    marginBottom = 50,
		    marginLeft = 100,
		    groupPadding = 0,
			pointPadding = 0.3,
		    chartHeight = marginTop 
                + marginBottom 
                + ((pointWidth * countData) * (1 + groupPadding + pointPadding));
			
		Highcharts.setOptions({
			lang: {
				thousandsSep: '.'
			}
		})
		Highcharts.chart("<?= $type . '-' . $smt . '-' . $thn ?>", {
		    chart: {
		        type: 'bar',
		        marginTop: marginTop,
				marginRight: marginRight,
				marginBottom: marginBottom,
				marginLeft: marginLeft,
				height: chartHeight
		    },
		    title: {
		        text: 'Realisasi Pendapatan Desa'
		    },
		    subtitle: {
		        text: "<?= 'Semester '.$smt.' Tahun '.$thn ?>"
		    },
		    xAxis: {
		        categories: [<?= join($jp, ',') ?>]
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Realisasi'
		        },
		        labels: {
		            overflow: 'justify',
		            enabled: false
		        }
		    },
		    tooltip: {
		        valueSuffix: ''
		    },
		    plotOptions: {
		        bar: {
		            dataLabels: {
		                enabled: true
		            }
		        },
		        series: {
		            pointWidth: pointWidth,
		            grouping: false
		        }
		    },
		    legend: {
		        layout: 'vertical',
		        align: 'right',
		        verticalAlign: 'top',
		        x: 0,
		        y: 0,
		        floating: true,
		        borderWidth: 1,
		        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
		        shadow: true
		    },
		    credits: {
		        enabled: false
		    },
		    series: [{
		        name: 'Anggaran',
		        dataLabels: {
		        	formatter: function () {
		        		return 'Rp' + Highcharts.numberFormat(this.y, '.', ',');
		        	}
		        },
		        data: [<?= join($anggaran, ',') ?>]
	        },{
		        name: 'Realisasi',
		        dataLabels: {
				    formatter: function () {
				    	var index = this.series.data.indexOf(this.point);
				    	var pointB = this.series.chart.series[0].data[index].y;
				    	var percent = Highcharts.numberFormat(this.y / pointB * 100, 0);
				    	// console.log(percent)
				    	return ' (' + percent + ' %'+')';
				    }
			    },
		        data: [<?= join($realisasi, ',') ?>]
		    }]
		});
	});
</script>