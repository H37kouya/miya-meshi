import { Menu } from './Menu'

export type MenuFormState = {
  menu: {
    name: Menu['name'],
    description: Menu['description'],
    intro: Menu['intro'],
    image: Menu['image'],
    price: Menu['price'],
    public: Menu['public'],
    isTaxIncluded: Menu['isTaxIncluded'],
    canTakeOut: Menu['canTakeOut']
  }
}
