export default function SecondaryButton({text, action}){
    return(
        <>
        <button className="bg-zinc-800 text-white py-2 rounded-full" onClick={action}>{text}</button>
        </>
    )
}
