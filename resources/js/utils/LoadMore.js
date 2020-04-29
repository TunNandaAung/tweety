import {throttle} from 'loadash';

export default{
	props :{
		container : {} 
	},

	mounted(){
		window.addEventListener('scroll',this.loadMore);
	},

	methods:{
		loadMore : throttle(function (e){
			if(this.shouldLoadMore()){
				this.$emit('ready');
			}
		},3000),

		shouldLoadMore(){
			let containerHeight = $(this.container).height();

			let distenceFromWindowTop = $(this.container).offset().top;


			return{
				window.pageYOffset >=
				(distenceFromWindowTop + containerHeight ) * 0.7
			};
		}
	}
}