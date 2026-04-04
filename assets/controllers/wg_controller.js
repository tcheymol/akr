import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['container']
    static values = {
        id: Number,
        wgId: Number,
    }

    connect() {
        const scriptId = `wg_fwdg_${this.idValue}`;
        const arg = [`s=${this.wgIdValue}`, "m=100", `uid=${scriptId}`, "wj=knots", "tj=c", "waj=m", "odh=0", "doh=24", "fhours=240", "hrsm=2", "vt=forecasts", "lng=en", "idbs=1", "p=WINDSPD,GUST,SMER,TMP,FLHGT,CDC,APCP1s,RATING"];
        const script = document.createElement("script");
        script.id = scriptId
        script.src = "https://www.windguru.cz/js/widget.php?" + (arg.join("&"));

        this.containerTarget.appendChild(script);
    }
}
