import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets = ['container']
  editor = null;

  connect() {
    if (this.editor) return;
    window.ClassicEditor.create(this.containerTarget, {
        toolbar: ['heading', '|',
          'bold', 'italic', 'link', '|',
          'alignment', '|',
          'numberedList', 'bulletedList'
        ]
      }
    ).then(editor => { this.editor = editor; });
  }

  disconnect() {
    if (this.editor) {
      this.editor.destroy();
      this.editor = null;
    }
  }
}
