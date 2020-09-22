Vue.component('count-down',{
    data(){
        return {
            res:this.data1,
            nowTime:new Date(),
            count_down:{
                title:'',
                h:'',
                m:'',
                s:'',
            }
        }
    },
    props:{
        data1:{},

    },
    mounted(){
        this.countTime();
    },
    methods:{
        // 获取年月日的时间字符串
        getYmd(){
            let date=this.nowTime;
            let y=date.getFullYear()
            let mm=date.getMonth()+1
            let m=mm<10?'0'+mm:mm
            let dd=date.getDate()
            let d=dd<10?'0'+dd:dd
            let Ymd=y+'-'+m+'-'+d
            return Ymd;
        },
        // 获取开始时间的时间戳
        getStartStamp(i){
            let Ymd=this.getYmd();
            let startTime=i.start_at=='00:00:00'?Ymd+' 24:00:00':Ymd+' '+i.start_at;
            let startDate = new Date(startTime)
            let startStamp = startDate.getTime()
            return startStamp;
        },
        // 获取结束时间的时间戳
        getEndStamp(i){
            let Ymd=this.getYmd();
            let endTime=Ymd+' '+i.end_at;
            let endDate = new Date(endTime)
            let endStamp = endDate.getTime()
            return endStamp;
        },
        countTime: function() {
            // console.log(i);
            //获取当前时间
            let date = new Date();
            let nowStamp=date.getTime()
            //设置截止时间
            let endStamp=this.getEndStamp(this.data1);
            let startStamp=this.getStartStamp(this.data1);
            //时间差
            let c=null;
            if(endStamp>nowStamp && nowStamp>startStamp){
                this.count_down.title='距结束';
                // 计算距离结束的时间差
                c=endStamp-nowStamp;
            }
            else if(startStamp>nowStamp && endStamp>nowStamp){

                this.count_down.title='距开始';
                // 计算当前到开始的时间差
                c=startStamp-nowStamp;
            }
            else if(nowStamp>endStamp){
                this.count_down.title='明日开始';
                c=startStamp+86400000-nowStamp;
            }
            this.count_down.d = Math.floor(c / 1000 / 60 / 60 / 24)//天数我没用到，暂且写上

            if(Math.floor((c / 1000 / 60 / 60) % 24)<10){
                this.count_down.h='0'+Math.floor((c / 1000 / 60 / 60) % 24);
            }else{
                this.count_down.h =Math.floor((c / 1000 / 60 / 60) % 24)
            }
            if(Math.floor((c / 1000 / 60) % 60)<10){
                this.count_down.m='0'+Math.floor((c / 1000 / 60) % 60);
            }else{
                this.count_down.m =Math.floor((c / 1000 / 60) % 60)
            }
            if(Math.floor((c / 1000) % 60)<10){
                this.count_down.s='0'+Math.floor((c / 1000) % 60);
            }else{
                this.count_down.s = Math.floor((c / 1000) % 60)
            }
            // console.log(this.s)
            //递归每秒调用countTime方法，显示动态时间效果
            setTimeout(this.countTime, 1000)
        },
    },
});
