async function getWeather(sessionTime){
    return await axios.get('https://api.openweathermap.org/data/2.5/forecast?q=Minsk&appid=afbbe64f43e833ea7ae6cf1e17ca1b9c')
    .then(res => {
        const filterApi = res.data.list.filter(item => new Date(item.dt_txt).getTime() === sessionTime.getTime());
        if(filterApi[0] && filterApi[0].weather[0] && filterApi[0].weather[0].main){
            switch (filterApi[0].weather[0].main) {
                case 'Clouds':
                    return "../image/logo.png"
                    break;
                case 'Clear':
                    return "../image/stock-popcorn.png"
                    break;
                case 'Atmosphere':
                    return "../image/stock-popcorn.png"
                    break;
                case 'Snow':
                    return "../image/stock-popcorn.png"
                    break;
                case 'Rain':
                    return "../image/stock-popcorn.png"
                    break;
                case 'Drizzle':
                    return "../image/stock-popcorn.png"
                    break;
                case 'Thunderstorm':
                    return "../image/stock-popcorn.png"
                    break;
                default:
                    break;
            }
        }
        else {
            return "../image/stock-popcorn.png"
        }
    })
}

const sessions = document.getElementsByClassName('session-block');
const setBackground = async () => {
    for (let index = 0; index < sessions.length; index++) {
        let type = await getWeather(new Date(sessions.item(index).attributes.date.nodeValue))
        sessions.item(index).style.backgroundImage = `url(${type.toString()})`
    }
}
setBackground()
