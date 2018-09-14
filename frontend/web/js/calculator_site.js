if(document.getElementById('data-item-form')){
	var volume={
		container:document.getElementById('data-item-container'),
		calc_form:document.getElementById('data-item-form'),
		all_select:'',
		all_input:'',
		options_val:[],
		checked_val:[],
		all_val:[],
		correct_val:[],
		new_price:'',
		old_price_container:document.querySelectorAll('[data-item-old-price]')[0],
		original_price_container:document.querySelectorAll('[data-item-price]')[0],
		old_price_container_2:document.querySelectorAll('[data-item-old-price-2]')[0],
		original_price_container_2:document.querySelectorAll('[data-item-price-2]')[0],
		sale_container:document.querySelectorAll('[data-item-sale]')[0],
		old_price:document.querySelectorAll('[data-item-old-price]')[0].getAttribute('data-item-old-price'),
		original_price:document.querySelectorAll('[data-item-price]')[0].getAttribute('data-item-price'),
		return_selected:function(elem){
			this.all_select=this.calc_form.getElementsByTagName('select');
			this.options_val=[];
			for(var i=0;i<this.all_select.length;i++){
				this.options_val[i]=this.all_select[i].options[this.all_select[i].selectedIndex].value
			}
		},
		return_checked:function(elem){
			this.all_input=this.calc_form.querySelectorAll('input[type="checkbox"]');
			this.checked_val=[];
			for(var i=0;i<this.all_input.length;i++){
				if(this.all_input[i].checked==false){
					this.checked_val[i]='0'
				}else{
					this.checked_val[i]=this.all_input[i].value
				}
			}
		},
		search:function(src){
			this.return_selected();
			this.return_checked();
			this.calc_price()
		},
		number_format:function(number,decimals,dec_point,thousands_sep){
			number=(number+'').replace(/[^0-9+\-Ee.]/g,'');
			var n=!isFinite(+number)?0:+number;
			var prec=!isFinite(+decimals)?0:Math.abs(decimals);
			var sep=(typeof thousands_sep==='undefined')?',':thousands_sep;
			var dec=(typeof dec_point==='undefined')?'.':dec_point,s='';
			var toFixedFix=function(n,prec){
				var k=Math.pow(10,prec);return''+(Math.round(n*k)/k).toFixed(prec)
			};
			var s=(prec?toFixedFix(n,prec):''+Math.round(n)).split('.');
			if(s[0].length>3){
				s[0]=s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,sep)
			}
			if((s[1]||'').length<prec){
				s[1]=s[1]||'';s[1]+=new Array(prec-s[1].length+1).join('0')
			}
			return s.join(dec)
		},
		calc_price:function(){
			this.all_val=[];
			this.correct_val=[];
			this.new_price=this.old_price;
			this.all_val=this.options_val.concat(this.checked_val);
			this.correct_val=this.all_val.filter(function(num){return num!=0});
			for(var i=0;i<this.correct_val.length;i++){
				this.new_price=Number(this.new_price)+Number(this.correct_val[i])
			}
			this.new_price=(this.number_format(this.new_price/100,0,',',''))*100;
			var sale=(this.number_format(((this.new_price-((this.new_price)-(this.new_price*0.1)))/100),0,',',''))*100;
			this.sale_container.innerHTML=this.number_format(sale,0,',',' ');
			var original_price=(this.number_format((this.new_price-(this.new_price*0.1))/100,0,',',''))*100;
			this.original_price_container.innerHTML=this.number_format(original_price,0,',',' ');
			this.old_price_container.innerHTML=this.number_format((this.new_price),0,',',' ');
			this.original_price_container_2.innerHTML=this.number_format(original_price,0,',',' ');
			this.old_price_container_2.innerHTML=this.number_format((this.new_price),0,',',' ')
		}
	}
}
