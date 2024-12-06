export default function SecondaryButton({text, action}){
    return(
        <>
        <button className="bg-zinc-800 text-white py-2 rounded-full hover:cursor-pointer" onClick={action}>{text}</button>
        </>
    )
}
