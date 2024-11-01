/**
 * Created by Radu on 27/04/2017.
 */
(function( $ ) {
    jQuery(document).ready(function($){

    	function hours_structure( base_hour ) {
    		var is_pm = 0;
    		if ( base_hour[0] == '+' ) {
    			is_pm = 1;
    			base_hour = base_hour.substr(1, base_hour.length);
    		}
    		var hour = base_hour.substr(0, 2);
    		var minute = base_hour.substr(2, 3);
    		if ( is_pm == 1 ) {
    			return hour + ':' + minute + ' pm';
    		} else {
    			return hour + ':' + minute + ' am';
    		}
    	}
        var brute_hours = $('#opening_hours')[0].innerText;
        var final_html = '';
        var changed_hours = fourSq.util.HoursParser.parse(brute_hours) ;
        $.each(changed_hours.timeframes, function (i, j) {
            var hours_object = changed_hours.timeframes[i];
            $.each(hours_object.days, function (key, val) {
                switch (hours_object.days[key]) {
                    case 1:
                        final_html += '<div class="monday"><div class="day">Monday</div><div class="hours">' + hours_structure ( hours_object.open[0].start ) + ' - ' + hours_structure ( hours_object.open[0].end ) + '</div></div>';
                        break;
                    case 2:
                        final_html += '<div class="tuesday"><div class="day">Tuesday</div><div class="hours">' + hours_structure ( hours_object.open[0].start ) + ' - ' + hours_structure ( hours_object.open[0].end ) + '</div></div>';
                        break;
                    case 3:
                        final_html += '<div class="wednesday"><div class="day">Wednesday</div><div class="hours">' + hours_structure ( hours_object.open[0].start ) + ' - ' + hours_structure ( hours_object.open[0].end ) + '</div></div>';
                        break;
                    case 4:
                        final_html += '<div class="thursday"><div class="day">Thursday</div><div class="hours">' + hours_structure ( hours_object.open[0].start ) + ' - ' + hours_structure ( hours_object.open[0].end ) + '</div></div>';
                        break;
                    case 5:
                        final_html += '<div class="friday"><div class="day">Friday</div><div class="hours">' + hours_structure ( hours_object.open[0].start ) + ' - ' + hours_structure ( hours_object.open[0].end ) + '</div></div>';
                        break;
                    case 6:
                        final_html += '<div class="saturday"><div class="day">Saturday</div><div class="hours">' + hours_structure ( hours_object.open[0].start ) + ' - ' + hours_structure ( hours_object.open[0].end ) + '</div></div>';
                        break;
                    case 7:
                        final_html += '<div class="sunday"><div class="day">Sunday</div><div class="hours">' + hours_structure ( hours_object.open[0].start ) + ' - ' + hours_structure ( hours_object.open[0].end ) + '</div></div>';
                        break;
                    default:
                        break;
                }
            });
        });
        $('#opening_hours').html(final_html);
    });
})( jQuery );
