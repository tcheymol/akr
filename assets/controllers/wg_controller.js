import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['container']
    static values = {
        id: Number,
    }

    connect() {
        var arg = [`s=${this.idValue}`, "m=100", "uid=wg_fwdg_216360_100_1655040885667", "wj=knots", "tj=c", "waj=m", "odh=0", "doh=24", "fhours=240", "hrsm=2", "vt=forecasts", "lng=en", "idbs=1", "p=WINDSPD,GUST,SMER,TMP,FLHGT,CDC,APCP1s,RATING"];
        var script = document.createElement("script");
        script.id = "wg_fwdg_216360_100_1655040885667"
        script.src = "https://www.windguru.cz/js/widget.php?" + (arg.join("&"));

        this.containerTarget.appendChild(script);
    }
}
