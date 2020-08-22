import { Menu } from './Menu'

export type MenuFormState = {
  menu: {
    name: Menu['name'],
    description: Menu['description'],
    dishes: Menu['dishes'],
    keywords: Menu['keywords'],
    intro: Menu['intro'],
    image: Menu['image'],
    price: Menu['price'],
    public: Menu['public'],
    priority: Menu['priority'],
    isTaxIncluded: Menu['isTaxIncluded'],
    canTakeOut: Menu['canTakeOut'],
    timeZone: Menu['timeZone']
  }
}
