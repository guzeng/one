
var validator = function(){
	return {
		/**
		 * param txt: The text of validate tip.
		 *       tip: The jQuery element of validate.
		 */
		updateTips : function(msg, tip ,obj) {
			obj.removeClass('normalBorder');
			obj.addClass('errorBorder');
			tip.text(msg);
			tip.show();
			obj.focus(function(){tip.html("");tip.hide();obj.removeClass('errorBorder');obj.addClass('normalBorder');});
		},
		/**
		 * param tip: The jQuery element of validate.  
		 */
		clearTips : function(tip) {
			
			tip.empty();
		},
		/**
		 * Check the input for length.
		 * param obj: The jQuery element to validate.
		 *       name: The jQuery element of validate name.
		 * 		 min: The min length.
		 * 		 max: The max length.
		 *		 tip: The jQuery element of validate.
		 *
		 * return boolean
		 */
		checkLength : function(obj, msg, min, max, tip) {
			if ( obj.val().length > max || obj.val().length < min ) {
				//obj.addClass('ui-state-error');
				obj.addClass('ui-state-highlight');
				this.updateTips(msg, tip ,obj);
				return false;
			} else {
				return true;
			}
		},
		checkNull : function(obj, msg, tip) {
			if ( obj.val().length <= 0 ) {
				//obj.addClass('ui-state-error');
				obj.addClass('ui-state-highlight');
				this.updateTips(msg, tip ,obj);
				return false;
			} else {
				return true;
			}
		},
		/**
		 * Check the input for length.
		 * param obj: The jQuery element to validate.
		 *       regexp: The javascript Reg object of input.
		 * 		 msg: The jQuery element of validate tip text.
		 * 		 max: The max length.
		 *		 tip: The jQuery element of validate form.
		 *
		 * return boolean
		 */
		checkRegexp : function(obj, regexp, msg, tip) {
			if ( !( regexp.test( obj.val() ) ) ) {
				//obj.addClass('ui-state-error');
				obj.addClass('ui-state-highlight');
				this.updateTips(msg, tip ,obj);
				return false;
			} else {
				return true;
			}
		},
		
		checkSelect : function(msg,tip,obj){
			if(obj.val()=="NONE") {
				obj.addClass('ui-state-highlight');
				this.updateTips(msg, tip ,obj);
				return false;
			}else {
				return true;
			}
		},
		checkNumber : function(obj, msg,tip){
			if(obj.val()!=""){
				var reg=new RegExp("^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$");
				var result=reg.test(obj.val());
				if(!result){
					obj.addClass('ui-state-highlight');
					his.updateTips(msg, tip ,obj);
					return false;
				}else {
					return true;
				}
			}
			return true;
		},
		
		checkZheng : function(obj, msg, tip) {
			if ( parseInt(obj.val())<0 ) {
				//obj.addClass('ui-state-error');
				obj.addClass('ui-state-highlight');
				this.updateTips(msg, tip ,obj);
				return false;
			} else {
				return true;
			}
		},
		/**
		 * 
		 * @param obj_val
		 * @param obj
		 * @param msg
		 * @param tip
		 * @returns boolean
		 * 
		 * @author <a href="mailto:setsuna.wei@dorsia.hk">setsuna.wei</a>
		 */
		checkModal:function(obj_val,obj,msg,tip){
			if(obj_val==obj.val()){
				//alert("abcdefg");
				obj.addClass('ui-state-highlight');
				this.updateTips(msg, tip ,obj);
				return false;
			}else {
				return true;
			}
		},
		/**
		 * Check the input for exist 
		 * @returns boolean
		 * 
		 * @author 
		 */
		checkExist:function(url_, objName, obj, tip){
			var temp = false;
			$.ajax({
				type:'post',
				url:url_,
				async:false,//同步传输
				dataType:'json',
				data:{"field":objName,"field_value":obj.val()},
				success: function(data){
					if(data.code!='1000'){
						obj.removeClass('normalBorder');
						obj.addClass('errorBorder');
						tip.text(data.msg);
						tip.show();
						obj.focus(function(){tip.html("");tip.hide();obj.removeClass('errorBorder');obj.addClass('normalBorder');});

						temp = false;
					}else
						temp = true;
				}
			});
			return temp;
		}
	};
};
