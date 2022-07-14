import { Controller } from '@hotwired/stimulus';
import Dropzone from "dropzone";
import 'dropzone/dist/dropzone.css';
import 'dropzone/dist/basic.css';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static targets = ['container']
  static values = {
    url: String,
  }

  connect() {
    let myDropzone = new Dropzone(".dropzone", {
      url: this.urlValue,
    });

    myDropzone.on("addedfile", file => {
      console.log(`File added: ${file.name}`);
    });
  }
}
