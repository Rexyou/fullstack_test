import React, { useState } from 'react'

export default function Answer({ total_player, player_card_list, remaining_list }) {


  return (
    <div>
      <h1>Game details</h1>
      <h2>Total players: { total_player }</h2>
      {
        Object.values(player_card_list).map((card, index)=> {
          return <div key={index}>Player_{index+1} : {card}</div>
        })
      }
    </div>
  )
}
