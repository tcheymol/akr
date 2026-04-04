import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets = ['container']

  connect() {
    window.ClassicEditor.create(this.containerTarget, {
        toolbar: ['heading', '|',
          'bold', 'italic', 'link', '|',
          'alignment', '|',
          'numberedList', 'bulletedList'
        ]
      }
    );
  }
}
