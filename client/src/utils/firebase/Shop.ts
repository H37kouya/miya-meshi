import initFirebase, { db } from './InitFirebase'

initFirebase()

export const createShop = async () => {
  console.log(db)
  const shop = {
    name: 'yatta--'
  }

  try {
    const docRef = await db.collection("shops").add(shop)
    console.log("Document written with ID: ", docRef.id)
  } catch (error) {
    console.error("Error adding document: ", error)
  }
}
