class LoadAfter {
  constructor(elements) {
    this.length = elements.length;
    this.counter = 0;

    elements.forEach((element) => {
      if (element.complete) {
        this.incrementCounter();
      } else {
        element.addEventListener("load", () => this.incrementCounter(), false);
      }
    });
  }

  incrementCounter() {
    this.counter++;
    if (this.counter === this.length) {
      document.body.style.opacity = "1";
    }
  }
}

export default LoadAfter;
