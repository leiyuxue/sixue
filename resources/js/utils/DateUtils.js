// 当前日期
let now = new Date();
// 今天本周的第几天
let nowDayOfWeek = now.getDay();
// 当前日
let nowDay = now.getDate();
// 当前月
let nowMonth = now.getMonth();
// 当前年
let nowYear = now.getYear();
nowYear += (nowYear < 2000) ? 1900 : 0;

class DateUtils {
    static parseLongDate (dateStr) {
        return Date.parse(dateStr.replace(/-/g, '/'));
    }

    // 格式化日期：yyyy-MM-dd
    static formatDate (date) {
        let myyear = date.getFullYear();
        let mymonth = date.getMonth() + 1;
        let myweekday = date.getDate();

        if (mymonth < 10) {
            mymonth = '0' + mymonth;
        }
        if (myweekday < 10) {
            myweekday = '0' + myweekday;
        }
        return (myyear + '-' + mymonth + '-' + myweekday);
    }

    // 格式化日期：yyyy-MM-dd
    static formatLongDate (date) {
        let myyear = date.getFullYear();
        let mymonth = date.getMonth() + 1;
        let myweekday = date.getDate();
        let myHour = date.getHours();
        let myMin = date.getMinutes();
        let mySec = date.getSeconds();

        if (mymonth < 10) {
            mymonth = '0' + mymonth;
        }
        if (myweekday < 10) {
            myweekday = '0' + myweekday;
        }
        if (myHour < 10) {
            myHour = '0' + myHour;
        }
        if (myMin < 10) {
            myMin = '0' + myMin;
        }
        if (mySec < 10) {
            mySec = '0' + mySec;
        }
        return (myyear + '-' + mymonth + '-' + myweekday + ' ' + myHour + ':' + myMin + ':' + mySec);
    }

    // 获得某月的天数
    static getMonthDays (myMonth) {
        let monthStartDate = new Date(nowYear, myMonth, 1);
        let monthEndDate = new Date(nowYear, myMonth + 1, 1);
        let days = (monthEndDate - monthStartDate) / (1000 * 60 * 60 * 24);
        return days;
    }

    // 获得本季度的开始月份
    static getQuarterStartMonth () {
        let quarterStartMonth = 0;
        if (nowMonth < 3) {
            quarterStartMonth = 0;
        }
        if (nowMonth > 2 && nowMonth < 6) {
            quarterStartMonth = 3;
        }
        if (nowMonth > 5 && nowMonth < 9) {
            quarterStartMonth = 6;
        }
        if (nowMonth > 8) {
            quarterStartMonth = 9;
        }
        return quarterStartMonth;
    }

    // 获得本周的开始日期
    static getWeekStartDate () {
        let weekStartDate = new Date(nowYear, nowMonth, nowDay - nowDayOfWeek);
        return this.formatDate(weekStartDate);
    }

    // 获得本周的结束日期
    static getWeekEndDate () {
        let weekEndDate = new Date(nowYear, nowMonth, nowDay + (6 - nowDayOfWeek));
        return this.formatDate(weekEndDate);
    }

    // 获得本月的开始日期
    static getMonthStartDate () {
        let monthStartDate = new Date(nowYear, nowMonth, 1);
        return this.formatDate(monthStartDate);
    }

    // 获得本月的结束日期
    static getMonthEndDate () {
        let monthEndDate = new Date(nowYear, nowMonth, this.getMonthDays(nowMonth));
        return this.formatDate(monthEndDate);
    }

    // 获得本季度的开始日期
    static getQuarterStartDate () {
        let quarterStartDate = new Date(nowYear, this.getQuarterStartMonth(), 1);
        return this.formatDate(quarterStartDate);
    }

    // 或的本季度的结束日期
    static getQuarterEndDate () {
        let quarterEndMonth = this.getQuarterStartMonth() + 2;
        let quarterStartDate = new Date(nowYear, quarterEndMonth, this.getMonthDays(quarterEndMonth));
        return this.formatDate(quarterStartDate);
    }
    static getDateWeek (date) {
        let week = ['周日', '周一', '周二', '周三', '周四', '周五', '周六'];
        return week[date.getDay()];
    }


    static utc2beijing(utc_datetime) {
        // 转为正常的时间格式 年-月-日 时:分:秒
        let T_pos = utc_datetime.indexOf('T');
        let Z_pos = utc_datetime.indexOf('Z');
        let year_month_day = utc_datetime.substr(0,T_pos);
        let hour_minute_second = utc_datetime.substr(T_pos+1,Z_pos-T_pos-1);
        let new_datetime = year_month_day+" "+hour_minute_second; // 2017-03-31 08:02:06
        // 处理成为时间戳
        timestamp = new Date(Date.parse(new_datetime));
        timestamp = timestamp.getTime();
        timestamp = timestamp/1000;
        // 增加8个小时，北京时间比utc时间多八个时区
        let timestamp = timestamp+8*60*60;
        // 时间戳转为时间
        let date = new Date(parseInt(timestamp) * 1000);
        //let beijing_datetime =date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
        var y = date.getFullYear();
        var m = date.getMonth() + 1;
        m = m < 10 ? ('0' + m) : m;
        var d = date.getDate();
        d = d < 10 ? ('0' + d) : d;
        var h = date.getHours();
        h = h < 10 ? ('0' + h) : h;
        var minute = date.getMinutes();
        var second = date.getSeconds();
        minute = minute < 10 ? ('0' + minute) : minute;
        second = second < 10 ? ('0' + second) : second;
        let beijing_datetime= y + '-' + m + '-' +d+' '+h+':'+minute+':'+second;

        return beijing_datetime; // 2017-03-31 16:02:06
    }
    static time_stamp(date) {
        var date = new Date(date);
        var YY = date.getFullYear() + '-';
        var MM = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
        var DD = (date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate());
        var hh = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':';
        var mm = (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()) + ':';
        var ss = (date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds());
        return YY + MM + DD +" "+hh + mm + ss;
    }


}
export default DateUtils;
