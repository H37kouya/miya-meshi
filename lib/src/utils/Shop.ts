import { Shop } from "../../types";
import { Type } from "../../enum";

/**
 * Shop型かどうか
 *
 * @param { any } v
 */
const isShop = (v: any): v is Shop => typeof v === 'object' && v.type === Type.SHOP

export {
    isShop
}
